<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Cloudinary\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * show create product form
     *
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
     *
     * @return view
     */
    public function getAllProductsForASubcategory(Subcategory $subCategory): View
    {
        $products = $subCategory->products;
     return view('product.products' ,['products' => $products]);
    }

    /**
     * Show a product
     *
     */
    public function show( Product $product )
    {
       return view('product.show' ,compact('product'));
    }

    /**
     * validate and store products
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( Request $request): RedirectResponse
    {
        $request->validate([
            'subcategory'=> 'required',
            'name' => 'required',
            'brand' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg,webp',
            'price'=>'required',
            'description' => 'required'
        ]);

        //upload image to cloudinary
        $uploadedFile = $request->file('file')->getRealPath();
        $cloudinaryResponse = Cloudinary::upload($uploadedFile);

        // Get the public ID and URL of the uploaded image
        $publicId = $cloudinaryResponse->getPublicId();
        $imageUrl = $cloudinaryResponse->getSecurePath();



      $product =  Product::create([
//            'category_id' => $request['category'],
            'subcategory_id' => $request['subcategory'],
            'name' => $request['name'],
            "brand_id" => $request['brand'],
            'price' =>$request['price'],
            'description' =>$request['description'],
            'file_path' => $imageUrl,
        ]);
  dd($product);
        return redirect()->route('subcategory.show',$request['subcategory']);
    }
}
