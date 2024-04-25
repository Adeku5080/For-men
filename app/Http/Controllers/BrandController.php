<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);

        Brand::create([
            'name' => $request['name'],
        ]);

        return redirect()->route('brand.create');

    }
}
