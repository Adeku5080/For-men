<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * add item to cart
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addToCart(Request $request): JsonResponse
    {
        $request->validate([
                  'size' => 'required',
                   'quantity' => 'required'
            ]);

        $id = $request->productId;
        $product = Product::find($id);

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'checked_out_at' => null,
        ]);



        $cartItems = CartItem::updateOrCreate(
            [
                'product_id' => $product->id,
                'size' => $request->size,
                'cart_id' => $cart->id,
                'item_file_path' => $product->file_path,
                'item_name' => $product->name,
                'item_price' => $product->price
            ],
            [
                'quantity' => $request->quantity,
            ]
        );
       return new JsonResponse( ['data'=> $cartItems],200);
    }

    /**
     * get cart Items count
     *
     */
    public function getCartItemsCount(): JsonResponse
    {
        $user = Auth::user();
        $count = $user->activeCart->cartItems()->count();

        return new JsonResponse(['data'=> $count],200);
    }
}
