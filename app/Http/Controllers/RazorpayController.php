<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;


class RazorpayController extends Controller
{

    public function createRazorpayOrder(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
        $order = $api->order->create([
            'receipt' => uniqid(),
            'amount' => 50000, // amount in paise (e.g., ₹500)
            'currency' => 'INR'
        ]);
    
        return response()->json([
            'order_id' => $order['id'],
            'amount' => $order['amount'],
            'currency' => $order['currency']
        ]);
    }
    
}
