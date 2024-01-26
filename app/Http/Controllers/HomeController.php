<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * show home page
     *
     *
     */
    public function index()
    {
        $categories = Category::all();
      return view('home',compact('categories'));
    }



}
