<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Fetch all categories.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return new JsonResponse(['data' => $categories]);
    }

    /**
     * get a category
     *
     * @param Category $category
     * @return JsonResponse
     *
     */
    public function show(Category $category)
    {
        if(!$category ){
            return new JsonResponse(['message' => 'Record not found'],404);
        }
        return new JsonResponse(['data' => $category],200);
    }

    /**
     * Fetch all subcategories belonging to a category.
     *
     * @param Category $category
     * @return JsonResponse
     *
     */
    public function subCategories(Category $category): JsonResponse
    {
        $subCategories = $category->subCategories;
        return new JsonResponse([
            'data' => $subCategories]);


    }

}
