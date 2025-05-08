<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ProductApiController extends Controller
{
    /**
     * get all products
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return new JsonResponse(['data' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {

    }

    /**
     * get a product
     */
    public function show(Product $product): JsonResponse
    {
        if (! $product) {
            return new JsonResponse(['message' => 'Record not found'], 404);
        }

        return new JsonResponse(['data' => $product], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(Request $request, $id): Response
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        if (! $product) {
            return new JsonResponse(['message' => 'record not found'], 404);
        }
        $product->delete();

        return new JsonResponse(200);
    }

    public function fetchVariant($color,$product)
    {
        $result = DB::select(
            '
    SELECT * 
    FROM products 
    JOIN product_variants ON products.id = product_variants.product_id
    JOIN attribute_option_product_variant aopv ON product_variants.id = aopv.product_variant_id
    JOIN attribute_options on attribute_options.id = aopv.attribute_option_id 
    JOIN attributes on attributes.id = attribute_options.attribute_id 
    WHERE products.id = :product and attribute_options.value = :color
    ',
            ['product' => $product, 'color' => $color]
        );

        return new JsonResponse(['product' =>$result],200);
    }

    public function fetchVariantBySlug($slug) 
    {
        $productVariant = ProductVariant::with(['product', 'attributeOptions.attribute'])->where('slug', $slug)->firstOrFail();

        return new JsonResponse(['product' => $productVariant], 200);
    }

}
