<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * show cart page
     *
     * @return view
     *
     */
    public function create()
    {
        return view('cart.cart');
    }

    /**
     * @return View
     *
     */
    public function getItemsFromCart(): View
    {
        $cartItems = CartItem::all();
        dd($cartItems);
        return view('cart.cart',compact('cartItems'));

    }

}
