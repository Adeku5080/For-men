<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    /**
     * show all wallets
     *
     * @return View
     */
    public function showAllWallets()
    {
        return view('product.wallets');
    }

    /**
     * show all watches
     *
     * @return View
     */
    public function showAllWatches()
    {
        return view('product.watches');
    }
}
