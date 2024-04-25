<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ClothingController extends Controller
{
    /**
     * show all joggers
     *
     * @return View
     */
    public function showAllJoggers()
    {
        $joggers = Product::where('subcategory_id', 4)
            ->get();

        return view('product.joggers', compact('joggers'));
    }

    /**
     * show all t-shirts
     *
     * @return View
     */
    public function showAllTshirts()
    {
        $tshirts = Product::where('subcategory_id', 1)
            ->get();

        return view('product.t-shirts', compact('tshirts'));
    }

    /**
     * show all shorts
     *
     * @return View
     */
    public function showAllShorts()
    {
        $shorts = Product::where('subcategory_id', 2)
            ->get();

        return view('product.shorts', compact('shorts'));
    }

    /**
     * show all shirts
     *
     * @return View
     */
    public function showAllShirts()
    {
        $shirts = Product::where('subcategory_id', 3)
            ->get();

        return view('product.shirts', compact('shirts'));
    }
}
