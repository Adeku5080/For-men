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

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'country' => 'required',
        ]);

        Checkout::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone_no' => $request['phone'],
            'country' => $request['country'],
        ]);

        return redirect()->route('payment');
    }
}
