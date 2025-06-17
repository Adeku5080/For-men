<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller
{
    /**
     * get all cartItems
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();

        //get cart items from redis
        $cartKey = "cart:{$user->id}";

        $cachedCart = Redis::get($cartKey);

        if (!$cachedCart) {
            $cartItems = DB::table('cart_items')
                ->join('carts', 'carts.id', '=', 'cart_items.cart_id')
                ->where('carts.user_id', $user->id)
                ->where('carts.status', 'active')
                ->get();

            Redis::setex($cartKey, 3600, json_encode($cartItems->toArray()));
        } else {
            $cartItems = json_decode($cachedCart, true);
        }

        return new JsonResponse(['data' => $cartItems], 200);
    }

    /**
     * add item to cart
     */
    public function addToCart(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            return new JsonResponse(['message' => 'Please login to perform this action'], 403);
        }

        $variantId = $request->variant;
        $size = $request->size;

        $productVariant = ProductVariant::find($variantId);
        if (! $productVariant) {
            return new JsonResponse(['message' => 'Product variant does not exist'], 404);
        }

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'checked_out_at' => null,
        ]);

        // Redis key for the cart
        $cartKey = "cart:{$user->id}";

        // Unique key per item (e.g., "42_M" = variant 42, size M)
        $itemKey = "{$variantId}_{$size}";

        // Load existing cart from Redis
        $cachedCart = Redis::get($cartKey);

        $cachedCart = $cachedCart ? json_decode($cachedCart, true) : [];

        // If item already in cache, increase quantity
        if (isset($cachedCart[$itemKey])) {
            $cachedCart[$itemKey]['quantity'] += 1;
        } else {
            $cachedCart[$itemKey] = [
                'product_variant_id' => $variantId,
                'size' => $size,
                'cart_id' => $cart->id,
                'item_file_path' => $productVariant->file_path,
                'item_name' => $productVariant->variant_name,
                'item_price' => $productVariant->price,
                'quantity' => 1,
            ];
        }

        // Save updated cart to Redis (optional TTL: 2 hours)
        Redis::setex($cartKey, 7200, json_encode($cachedCart));

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_variant_id', $variantId)
            ->where('size', $size)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'product_variant_id' => $variantId,
                'size' => $size,
                'cart_id' => $cart->id,
                'item_file_path' => $productVariant->file_path,
                'item_name' => $productVariant->variant_name,
                'item_price' => $productVariant->price,
                'quantity' => 1,
            ]);
        }

        return new JsonResponse(['message' => 'Cart item added'], 200);
    }

    /**
     * get cart Items count
     */
    public function getCartItemsCount()
    {
        $user = Auth::user();

        //get cart items from redis
        $cartKey = "cart:{$user->id}";

        $cachedCart = Redis::get($cartKey);

        if ($cachedCart) {
            $cartItems = json_decode($cachedCart, true);
            $cartItemsCount = count($cartItems);
        } else {
            $cartItemsCount = DB::table('cart_items')
                ->join('carts', 'carts.id', '=', 'cart_items.cart_id')
                ->where('carts.user_id', $user->id)
                ->where('carts.status', 'active')
                ->count();
        }

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
    public function deleteCartItem($cartItemId): JsonResponse
    {
        $cartItem = CartItem::find($cartItemId);

        if (!$cartItem) {
            return new JsonResponse(['message' => 'The cart item with this Id does not exist'], 404);
        }

        $cartItem->delete();

        return new JsonResponse(['message' => 'cartItem removed from cart'], 204);
    }
}
