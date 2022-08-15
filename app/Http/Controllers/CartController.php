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
     * Add a product to cart
     *
     */
//    public function addToCart(Request $request, Product $product)
//    {
//        if (!Auth::user()) {
//            return redirect('/login');
//        };
//
//        $cart = Cart::firstOrCreate([
//            'user_id' => Auth::id(),
//            'checked_out_at' => null,
//        ]);
//
//        CartItem::updateOrCreate(
//            [
//                'product_id' => $product->id,
//                'size' => $request->size,
//                'cart_id' => $cart->id,
//            ],
//            [
//                'quantity' => $request->quantity,
//            ]
//        );
//
//        return redirect()->route('cart.show');
//    }

    /**
     * @return View
     *
     */
    public function getItemsFromCart()
    {
        $cartItems = CartItem::all();
        return view('cart.cart',compact('cartItems'));

    }
}
