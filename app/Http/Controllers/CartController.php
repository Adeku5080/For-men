<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * show cart page
     *
     * @return view
     */
    public function create()
    {
        return view('cart.cart');
    }

    public function getItemsFromCart(): View
    {
        $cartItems = CartItem::all();

        return view('cart.cart', compact('cartItems'));

    }
}
