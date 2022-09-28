<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
       $details = Checkout::all();
        return view('payment.payment',compact('details'));
    }
}
