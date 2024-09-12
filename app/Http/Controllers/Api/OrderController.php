<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    //create order
    public function createOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'required',
            'seller_id' => 'required',
            'items' => 'required|array',
            'items.*.product_id' => 'required',
            'items.*.quantity' => 'required',
            'shipping_price' => 'required',
            'shipping_service' => 'required',
        ]);

        $user = $request->user();

        $totalPrice = 0;
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            Log::debug('Product', ['product' => $product]);
            $totalPrice += $product->price * $item['quantity'];
        }

        $grandTotal = $totalPrice + $request->shipping_price;

        $order = $user->orders()->create([
            'address_id' => $request->address_id,
            'seller_id' => $request->seller_id,
            'shipping_price' => $request->shipping_price,
            'shipping_service' => $request->shipping_service,
            'status' => 'pending',
            'total_price' => $totalPrice,
            'grand_total' => $grandTotal,
            'transaction_number' => 'TRX-' . time(),
        ]);

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order created',
            'data' => $order,
        ], 201);
    }

    //update shipping number
    public function updateShippingNumber(Request $request, $id)
    {
        $request->validate([
            'shipping_number' => 'required|string',
        ]);

        $order = $request->user()->orders()->find($id);
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found',
            ], 404);
        }

        $order->update([
            'shipping_number' => $request->shipping_number,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Shipping number updated',
            'data' => $order,
        ]);
    }

    //history order buyer
    public function historyOrderBuyer(Request $request)
    {
        $orders = $request->user()->orders()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'List History Order Buyer',
            'data' => $orders,
        ]);
    }

    //History order seller
    public function historyOrderSeller(Request $request)
    {
        $orders = Order::where('seller_id', $request->user()->id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'List History Order Seller',
            'data' => $orders,
        ]);
    }
}
