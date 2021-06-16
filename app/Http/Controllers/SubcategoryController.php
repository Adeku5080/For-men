<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('',compact());
    }

    public function create()
    {
        return view('subcategory.create');
    }

    public function store( Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        $newImageName = time() . '-' .$request->name . '.' . $request->file->extension();
        $request->file->move(public_path('images/subC'),$newImageName);

        Subcategory::create([
            'category_name' => $request['name'],
            'file_path' => $newImageName
        ]);

    }

}
