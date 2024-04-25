<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShoesController extends Controller
{
    /**
     * show all trainers
     *
     * @return View
     */
    public function showAllTrainers()
    {
        $trainers = Product::where('sub_category_id', 5)
            ->get();

        return view('product.trainers', compact('trainers'));
    }

    /**
     * show all boots
     *
     * @return View
     */
    public function showAllBoots()
    {
        $boots = Product::where('sub_category_id', 6)
            ->get();

        return view('product.boots', compact('boots'));
    }

    /**
     * show all shoes
     *
     * @return View
     */
    public function showAllShoes()
    {
        $shoes = Product::where('sub_category_id', 7)
            ->get();

        return view('product.shoes', compact('shoes'));
    }
}
