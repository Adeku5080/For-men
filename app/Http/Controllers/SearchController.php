<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('name', 'Like', "%{$search}%")->get();

        return view('search', compact('products'));
    }
}
