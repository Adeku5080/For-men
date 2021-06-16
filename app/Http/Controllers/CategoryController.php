<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
      return view ('category.create');
    }

    public function store(Request $request)
    {
     // $test = $request->file('file')->isValid();
     // dd($test);

        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        $newImageName = time() . '-' .$request->name . '.' . $request->file->extension();
        $request->file->move(public_path('images'),$newImageName);

        Category::create([
            'category_name' => $request['name'],
            'file_path' => $newImageName
        ]);
    }
}
