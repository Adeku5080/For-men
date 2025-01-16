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

        // dd($sizeCharts);

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
            'variants.*.name' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric',
            'variants.*.sku' => 'required|string|unique:product_variants,sku',
            'brand' => 'required',

        ]);

        DB::transaction(function () use ($data) {
            $product = Product::create([
                'name' => $data['name'],
                'subcategory_id' => $data['subcategory'],
                'brand_id' => $data['brand'],
            ]);


            // Create variants and set the first one as the default
            $variants = $product->productVariants()->createMany($data['variants']);
            dd('ali');
            $product->update(['product_variant_id' => $variants[0]->id]);
        });

        //upload image to cloudinary
        // $uploadedFile = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

    }
}
