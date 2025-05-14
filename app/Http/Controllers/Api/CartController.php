<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        if (! Auth::user()) {
            return new JsonResponse(['message' => 'Please login to be able to perform this action'], 403);
        }

        $id = $request->variant;
        $productVariant = ProductVariant::find($id);

        if (!$productVariant) {
            return new JsonResponse(['message' => 'Product variant does not exist'], 404);
        }


        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'checked_out_at' => null,
        ]);

        $cartItem = CartItem::where('size', $request->size)
            ->where('product_variant_id', $id)->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + 1,
            ]);
        } else {
            CartItem::create([
                'product_variant_id' => $productVariant->id,
                'size' => $request->size,
                'cart_id' => $cart->id,
                'item_file_path' => $productVariant->file_path,
                'item_name' => $productVariant->variant_name,
                'item_price' => $productVariant->price,
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


        $cartItemsCount = DB::Select(
            "
             select count(*) from cartItems join carts on carts.id = cart_items.cart_id where carts.user_id = :userId

            ",
            ['userId' => $user]
        );


        return new JsonResponse(['data' => $cartItemsCount], 200);
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
