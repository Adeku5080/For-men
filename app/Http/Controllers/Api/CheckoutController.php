<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CheckoutController extends Controller
{
    public function createUserAddress(Request $request)
    {
        
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

        $data = Checkout::create([
            'firstname' => $request['first_name'],
            'lastname' => $request['last_name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone_no' => $request['mobile'],
            'country' => $request['country'],
        ]);

        return new JsonResponse(['data' => $data],200);
    }


}
