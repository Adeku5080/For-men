<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * show create product variant form
     */
    public function create()
    {
        return view(
            'product-variant.create',
            [
                'products' => Product::all(),
            ]
        );
    }

    /**
     * validate and store product variants
     */
    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'product' => 'required | string',
            'file' => 'required | string',
            'variant_name' => 'required | string',
            'product_details' => 'required | string',
            'quantity' => 'required|integer|min:1',
            'sku' => 'required | min:1',
        ]);

        dd('adeku');

        //upload image to cloudinary
        $uploadedFile = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

        $productVariants = ProductVariant::create([
            'file_path' => $uploadedFile,
            'product_details' => $request->product_details,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
            'product_id' => $request->product,
            'variant_name' => $request->variant_name,
        ]);
        dd('ali');

        return view('product-variant.create');

    }
}
