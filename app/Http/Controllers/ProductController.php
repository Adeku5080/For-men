<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


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
            ]
        );
    }

    /**
     * get all products belonging to a subcategory
     */
    public function getAllProductsForASubcategory(Subcategory $subCategory): View
    {
        $products = $subCategory->products;

        return view('product.products', ['products' => $products]);
    }

    /**
     * Show a product
     */
    public function show(Product $product)
    {


        return view('product.show', compact('product'));
    }

    /**
     * validate and store products
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subcategory' => 'required',
            'description' => 'nullable|string',
            'variants' => 'required|array',
            'variants.*.variant_name' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric',
            'variants.*.quantity' => 'required|numeric',
            'variants.*.amount' => 'required|numeric',
            'variants.*.product_details' => 'required',
            'variants.*.file_path' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'variants.*.sku' => 'required|string|unique:product_variants,sku',
            'brand' => 'required',
        ]);



        DB::transaction(function () use ($data) {
            $product = Product::create([
                'name' => $data['name'],
                'subcategory_id' => $data['subcategory'],
                'brand_id' => $data['brand'],
            ]);

            $uploadPaths = $this->uploadImagesToCloudinary($data);

            foreach ($data['variants'] as $key => $variant) {
                $variant['file_path'] = $uploadPaths[$key] ?? null;
            }


            $variants = $product->productVariants()->createMany($data['variants']);
            $product->update(['product_variant_id' => $variants[0]->id]);
        });
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
}
