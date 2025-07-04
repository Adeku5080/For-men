<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * show checkout page
     *
     * @return View
     */
    public function index()
    {
        return view('checkout.checkout');
    }

    /**
     * validate and store details
     */
    public function store(Request $request): RedirectResponse
    {
        dd($request->input());

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string',
            'mobile' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',


        ]);

        Checkout::create([
            'firstname' => $request['first_name'],
            'lastname' => $request['last_name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone_no' => $request['mobile'],
            'country' => $request['country'],
        ]);

        return redirect()->route('payment');
    }
}
