<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Subcategory;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * show create product form
     */
    public function create(): View
    {
        return view(
            'product.create',
            [
                'categories' => Category::all(),
                'brands' => Brand::all(),
                'attributes' => Attribute::with('attributeOptions')->get(),
            ]
        );
    }

    /**
     * get all products belonging to a subcategory
     */
    public function getAllProductsForASubcategory(Subcategory $subCategory): View
    {

        $result = DB::select(
            '
    SELECT * 
    FROM products 
    JOIN subcategories ON subcategories.id = products.subcategory_id 
    JOIN product_variants ON products.product_variant_id = product_variants.id 
    WHERE products.subcategory_id = :subcategoryId',
            ['subcategoryId' => $subCategory->id]
        );

        return view('product.products', ['products' => $result]);
    }

    /**
     * Show a product
     */
    public function show($slug)
    {
        $productVariant = ProductVariant::with(['product', 'attributeOptions.attribute'])->where('slug', $slug)->firstOrFail();

        $product = $productVariant->product;

        $variants = $product->productVariants()->with('attributeOptions.attribute')->get();

        $sizes = collect();
        $colors = collect();

        foreach ($variants as $variant) {
            foreach ($variant->attributeOptions as $option) {
                $name = strtolower($option->attribute->name);

                if ($name === 'color') {
                    $colors->push($option->value);
                }
            }
        }

        foreach ($productVariant->attributeOptions as $option) {
            $name = strtolower($option->attribute->name);

            if ($name === 'size') {
                $sizes->push($option->value);
            }
        }

        return view('product.show', [
            'variant' => $productVariant,
            'size' => $sizes->unique()->values()->all(),
            'color' => $colors->unique()->values()->all(),
        ]);
    }

    /**
     * validate and store products
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_name' => 'required|string|max:255',
            'subcategory' => 'required',
            'description' => 'nullable|string',
            'variants' => 'required|array',
            'variants.*.variant_name' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric',
            'variants.*.quantity' => 'required|numeric',
            'variants.*.product_details' => 'required',
            'variants.*.file_path' => 'required|file|mimes:webp|max:2048',
            'brand' => 'required',
        ]);

        DB::transaction(
            function () use ($data) {
                $product = Product::create([
                    'product_name' => $data['product_name'],
                    'subcategory_id' => $data['subcategory'],
                    'brand_id' => $data['brand'],
                ]);

                $uploadPaths = $this->uploadImagesToCloudinary($data);
                $productSlugs = $this->generateProductSlug($data);

                foreach ($data['variants'] as $key => $variant) {
                    $variantCopy = $variant;
                    $variantCopy['file_path'] = $uploadPaths[$key] ?? null;
                    $variantCopy['slug'] = $productSlugs[$key] ?? null;

                    //flatten variants attributes
                    $flattenedAttributes = collect($variant['attributes'])->flatten()->toArray();

                    $attributeOptions = AttributeOption::whereIn('id', $flattenedAttributes)
                        ->with('attribute')
                        ->get();

                    $size = [];
                    $color = null;

                    foreach ($attributeOptions as $option) {
                        if (strtolower($option->attribute->name) === 'size') {
                            $size[] = $option->value;
                        }
                        if (strtolower($option->attribute->name) === 'color') {
                            $color = $option->value;
                        }
                    }

                    $variantCopy['sku'] = generateSku($data['product_name'], $color);
                    $data['variants'][$key] = $variantCopy;
                }

                $variantsInserted = $product->productVariants()->createMany($data['variants']);
                $product->update(['product_variant_id' => $variantsInserted[0]->id]);

                foreach ($variantsInserted as $index => $variant) {
                    $attributeOptionIds = $data['variants'][$index]['attributes'] ?? [];
                    if (! empty($attributeOptionIds)) {
                        $flattenedAttributeOptions = collect($attributeOptionIds)->flatten()->toArray();
                        $variant->attributeOptions()->attach($flattenedAttributeOptions);
                    }
                }
            }
        );

        return redirect()->route('product.create')->with('success', 'Product created successfully.');
    }

    public function uploadImagesToCloudinary($data)
    {
        $uploadPaths = [];
        foreach ($data['variants'] as $variant) {
            $uploadPath = Cloudinary::upload($variant['file_path']->getRealPath())->getSecurePath();

            $uploadPaths[] = $uploadPath;
        }

        return $uploadPaths;
    }

    public function generateProductSlug($data)
    {
        $variantSlugs = [];
        foreach ($data['variants'] as $variant) {
            $slug = Str::slug($variant['variant_name']);

            $variantSlugs[] = $slug;
        }

        return $variantSlugs;
    }
}
