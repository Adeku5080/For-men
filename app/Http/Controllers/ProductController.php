<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SizeChartValue;
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
                'sizes' => SizeChartValue::all(),
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
        $sizeCharts = $product->sizechart()->get();

        // dd($sizeCharts);

        return view('product.show', compact('product', 'sizeCharts'));
    }

    /**
     * validate and store products
     */
    public function store(Request $request): RedirectResponse
    {
        dd($request->input('sizes'));
        $request->validate([
            'subcategory' => 'required',
            'name' => 'required',
            'brand' => 'required',
            // 'file' => 'required|mimes:jpg,png,jpeg,webp',
            'price' => 'required',
            'description' => 'required',
        ]);

        //upload image to cloudinary
        $uploadedFile = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

        //   $sizeCharts = [];

        $product = Product::create([
            'category_id' => $request['category'],
            'subcategory_id' => $request['subcategory'],
            'name' => $request['name'],
            'brand_id' => $request['brand'],
            'price' => $request['price'],
            'description' => $request['description'],
            'file_path' => $uploadedFile,
        ]);

        //   $product
        return redirect()->route('subcategory.show', $request['subcategory']);
    }
}
