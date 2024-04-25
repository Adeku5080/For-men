<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubcategoryController extends Controller
{
    /**
     * show a create subcategory form
     */
    public function create(): View
    {
        return view('subcategory.create', [
            'categories' => Category::all(),
        ]);
    }

    public function show(SubCategory $subCategory)
    {
        return view('subcategory.show', [
            'products' => $subCategory->products,
        ]);
    }

    /**
     * validate and store subcategories
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'category' => 'required|exists:categories,id',
            'name' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg,webp',
        ]);

        $newImageName = time().'-'.$request->name.'.'.$request->file->extension();
        $request->file->move(public_path('images/subcategoriesImgs'), $newImageName);

        $subcategory = SubCategory::create([
            'category_id' => $request['category'],
            'name' => $request['name'],
            'file_path' => $newImageName,
        ]);

        return redirect()->route('subcategory.create', $request['category']);
    }
}
