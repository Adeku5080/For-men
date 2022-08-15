<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GadgetsController extends Controller
{
    /**
     * show all phones
     *
     * @return View
     */
    public function showAllPhones()
    {
        return view('product.phones');
    }

    /**
     * show all laptops
     *
     * @return View
     */
    public function showAllLaptops()
    {
        return view('product.laptops');
    }
}
