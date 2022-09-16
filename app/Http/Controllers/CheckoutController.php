<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_no' => 'required'
        ]);
        dd($request['firstname']);

        Checkout::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone_no' => $request['phone']
        ]);

        return redirect()->route('payment');
    }
}

