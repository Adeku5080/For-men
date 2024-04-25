<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    /**
     * fetch all liked products
     */
    public function fetchAllSavedItems()
    {
        $favourites = Favourite::where('user_id', Auth::user()->id)->get();

        return view('favourites', compact('favourites'));
    }
}
