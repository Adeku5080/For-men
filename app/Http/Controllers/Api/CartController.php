<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * add item to cart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {
        dd($request->all());
       // todo: authenticate the API.

        // todo: validate the request.

        // fetch the product


        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'checked_out_at' => null,
        ]);

        CartItem::updateOrCreate(
            [
                'product_id' => $product->id,
                'size' => $request->size,
                'cart_id' => $cart->id,
            ],
            [
                'quantity' => $request->quantity,
            ]
        );

        return redirect()->route('cart.show');
    }
}
