<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * return all categories
     *
     */
    public function index()
    {
        $categories = Category::with('subCategories')
            ->get();

        return view('category.home',compact('categories'));
    }

    /**
     *show a create category form
     *
     * @return View
     */
    public function create(): View
    {
      return view ('category.create');
    }

    /**
     * show subcategories for each category
     *
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        return view('category.show', [
            'subCategories' => $category->subCategories,
        ]);
    }

    /**
     * validate and store category
     *
     * @param Request $request
     *
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        $newImageName = time() . '-' .$request->name . '.' . $request->file->extension();
        $request->file->move(public_path('images'),$newImageName);

        Category::create([
            'name' => $request['name'],
            'file_path' => $newImageName
        ]);
    }

    /**
     * Fetch all sub-categories of the given category.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function subCategories(Category $category): JsonResponse
    {
        return new JsonResponse($category->subCategories);
    }
}
