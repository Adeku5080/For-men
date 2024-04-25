<?php

namespace App\Http\Controllers;

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
