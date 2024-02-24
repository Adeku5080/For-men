<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavouritesController extends Controller
{
    /**
     *
     * fetch all liked products
     * @return
     */
    public function fetchAllSavedItems(){
        $favourites = Favourite::where('user_id',Auth::user()->id)->get();
        return view('favourites',compact('favourites'));
    }
}
