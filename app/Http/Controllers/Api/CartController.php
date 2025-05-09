<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * get all cartItems
     */
    public function index(): JsonResponse
    {
        $cartItems = CartItem::all();

        return new JsonResponse(['data' => $cartItems], 200);
    }

    /**
     * add item to cart
     */
    public function addToCart(Request $request)
    {
        if (!Auth::user()) {
            return new JsonResponse(['message' => 'Please login to be able to perform this action'], 403);
        }

        $id = $request->productId;
        $product = Product::find($id);

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'checked_out_at' => null,
        ]);


        $cartItem = CartItem::where('size', $request->size)
            ->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + 1,
            ]);
        } else {
            CartItem::create([
                'product_id' => $product->id,
                'size' => $request->size,
                'cart_id' => $cart->id,
                'item_file_path' => $product->file_path,
                'item_name' => $product->name,
                'item_price' => $product->price,
                'quantity' => 1,
            ]);
        }

        return new JsonResponse(['message' => 'cart item added'], 200);
    }

    /**
     * get cart Items count
     */
    public function getCartItemsCount()
    {
        $user = Auth::user();

        // if (!$user) {
        //     return new JsonResponse(['message' => 'Please login to be able to perform this action'], 403);
        // }

        $count = $user->activeCart->cartItems()->count();


        return new JsonResponse(['data' => $count], 200);
    }

    /**
     * update a cartitem
     */
    public function updateCartItem(CartItem $cartItem, Request $request): JsonResponse
    {
        $quantity = $request->quantity;
        $cartItem->update([
            'quantity' => $quantity,
        ]);

        return new JsonResponse(['message' => 'quantity has been updated'], 200);
    }

    /**
     * delete an item from cart
     */
    public function deleteCartItem(CartItem $cartItem): JsonResponse
    {
        $cartItem->delete();

        return new JsonResponse(['message' => 'cartItem removed from cart'], 200);
    }
}
