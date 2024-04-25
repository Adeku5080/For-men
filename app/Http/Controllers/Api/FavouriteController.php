<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * add to favourties
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'product_id' => $request->productId,
        ];

        $Favourite = Favourite::firstOrCreate($data);

        $message = $Favourite->wasRecentlyCreated ? 'Item has been saved' : 'Item has been removed from your saved items';

        return new JsonResponse(['data' => $Favourite, 'message' => $message], 201);
    }

    /**
     * get all favourites belonging to a user
     */

    /*
     * remove from favourites
     */
    public function removeFav(Product $product)
    {
        Favourite::where('product_id', $product->id)
            ->where('user_id', Auth::user()->id)
            ->delete();

        return new JsonResponse(['msg' => 'product removed from favourites'], 200);
    }
}
