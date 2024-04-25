<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
}
