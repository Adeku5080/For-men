<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
    public function store(Request $request)
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
    public function update(Request $request, $id)
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

    public function fetchVariant($color, $product)
    {
        $result = DB::select(
            "
   SELECT 
    pv.id AS product_variant_id,
    p.id AS product_id,
    GROUP_CONCAT(DISTINCT ao_size.value ORDER BY ao_size.value SEPARATOR ', ') AS sizes,
    pv.sku,
    pv.price,
    pv.slug,
    pv.product_id,
    pv.quantity,
    pv.file_path,
    pv.variant_name,
    pv.product_details
FROM products p
JOIN product_variants pv ON p.id = pv.product_id

JOIN attribute_option_product_variant aopv_color ON pv.id = aopv_color.product_variant_id
JOIN attribute_options ao_color ON ao_color.id = aopv_color.attribute_option_id
JOIN attributes attr_color ON attr_color.id = ao_color.attribute_id

JOIN attribute_option_product_variant aopv_size ON pv.id = aopv_size.product_variant_id
JOIN attribute_options ao_size ON ao_size.id = aopv_size.attribute_option_id
JOIN attributes attr_size ON attr_size.id = ao_size.attribute_id

WHERE p.id = :product
  AND ao_color.value = :color
  AND attr_color.name = 'Color'
  AND attr_size.name = 'Size'

GROUP BY pv.id

    ",
            ['product' => $product, 'color' => $color]
        );

        return new JsonResponse(['product' => $result], 200);
    }

    // public function fetchVariantBySlug($slug)
    // {
    //     $productVariant = ProductVariant::with(['product', 'attributeOptions.attribute'])->where('slug', $slug)->firstOrFail();

    //     $product = $productVariant->product;

    //     $variants = $product->productVariants()->with('attributeOptions.attribute')->get();

    //     $sizes = collect();
    //     $colors = collect();

    //     foreach ($variants as $variant) {
    //         foreach ($variant->attributeOptions as $option) {
    //             $name = strtolower($option->attribute->name);

    //             if ($name === 'color') {
    //                 $colors->push($option->value);
    //             }
    //         }
    //     }

    //     foreach ($productVariant->attributeOptions as $option) {
    //         $name = strtolower($option->attribute->name);

    //         if ($name === 'size') {
    //             $sizes->push($option->value);
    //         }
    //     }
    //     dd('aseku');

    //     return new JsonResponse([
    //         'product' => $productVariant,
    //         'size' => dd($sizes->sort()->unique()->values()->all()),
    //         'color' => $colors->unique()->values()->all(),
    //     ], 200);
    // }
}
