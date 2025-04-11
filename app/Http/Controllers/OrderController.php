<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // dd(1);
        // use Illuminate\Support\Facades\DB;

        $data = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
            ]);

            foreach ($data['products'] as $productData) {
                $product = Product::find($productData['id']);

                if ($product->stock < $productData['quantity']) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                $product->decrement('stock', $productData['quantity']);

                $order->products()->attach($product->id, ['quantity' => $productData['quantity']]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order' => $order->load('products')
            ]);

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }


    public function productsInStock()
    {
        $products = Product::where('stock', '>', 0)->get();

        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }

}
