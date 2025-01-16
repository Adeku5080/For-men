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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'subcategory' => 'required',
            'name' => 'required',
            'brand' => 'required',
            // 'description' => 'required',
        ]);

        //upload image to cloudinary
        // $uploadedFile = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

        $product = Product::create([
            'category_id' => $request['category'],
            'subcategory_id' => $request['subcategory'],
            'name' => $request['name'],
            'brand_id' => $request['brand'],
            // 'description' => $request['description'],
            // 'file_path' => $uploadedFile,
        ]);

        return view('product.create');
        // return redirect()->route('subcategory.show', $request['subcategory']);

    }

    /**
     * Add default variant
     */
    public function addDefaultVariantsToProduct(Request $request, Product $product)
    {
        $requet->validate([
            'product_variant_id' => 'requires | string',
        ]);

        $product->product_variant_id = 'product_variant_id';

        $product->save();

    }
}
