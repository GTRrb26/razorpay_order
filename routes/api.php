<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/products/in-stock', [OrderController::class, 'productsInStock']);
Route::post('/razorpay/order', [RazorpayController::class, 'createRazorpayOrder']);
//k- rzp_test_si9plNJQeZKSfC
//s -UGXjaXtheBL48xny5vaKzJlV