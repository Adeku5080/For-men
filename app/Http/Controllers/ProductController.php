<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProductVariant;

use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Subcategory;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



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
                'attributes' => Attribute::with('attributeOptions')->get()
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
        $productVariant = ProductVariant::where('slug', $slug)->first();

        if (!$productVariant) {
        }

        return view('product.show', ['variant' => $productVariant]);
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
            'variants.*.sku' => 'required|string|unique:product_variants,sku',
            'variants.*.stock_unit' => 'required|numeric',
            'brand' => 'required',
        ]);



        DB::transaction(function () use ($data) {
            $product = Product::create([
                'product_name' => $data['product_name'],
                'subcategory_id' => $data['subcategory'],
                'brand_id' => $data['brand'],
            ]);

            $uploadPaths = $this->uploadImagesToCloudinary($data);
            $productSlugs = $this->generateProductSlug($data);

            foreach ($data['variants'] as $key => &$variant) {
                $variant['file_path'] = $uploadPaths[$key] ?? null;
                $variant['slug'] = $productSlugs[$key] ?? null;
            }


            $variants = $product->productVariants()->createMany($data['variants']);
            $product->update(['product_variant_id' => $variants[0]->id]);
        });

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
