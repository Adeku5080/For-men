<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubCategoryController extends Controller
{
    /**
     * get all subcategories
     *
     * @return JsonResponse
     */
    public function index()
    {
        $subcategories = SubCategory::all();

        return new JsonResponse(['data'=> $subcategories],200);
    }

    /**
     * get a subcategory
     *
     * @param SubCategory $subCategory
     * @return JsonResponse
     */
     public function show(SubCategory $subCategory): JsonResponse
     {
         if($subCategory) {
             return new JsonResponse(['message' => 'Record not found'],404);
         }
         return new JsonResponse(['data' => $subCategory],200);
     }

    /**
     *Fetch all products that belong to a subcategory.
     *
     * @param SubCategory $subCategory
     * @return JsonResponse
     */
    public function products(SubCategory $subCategory): JsonResponse
    {
        $products = $subCategory->products;

        return new JsonResponse([
            'data' => $products,
        ]);
    }


}
