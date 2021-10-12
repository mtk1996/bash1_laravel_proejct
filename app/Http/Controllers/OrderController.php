<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeOrder()
    {
        $cart = Cart::where('user_id', auth()->id())->with('product')->get();
        foreach ($cart as $c) {
            Order::create([
                'user_id' => auth()->id(),
                'product_id' => $c->product_id,
                'quantity' => $c->quantity,
                'total_price' => $c->quantity * $c->product->price
            ]);
        }
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Order Success!');
    }


    public function orderList()
    {
        $status = request()->status;
        $order = Order::where('user_id', auth()->id())->with('product')->latest();
        if ($status == 'success') {
            $order->where('status', $status);
        }
        if ($status == 'pending') {
            $order->where('status', $status);
        }
        if ($status == 'cancel') {
            $order->where('status', $status);
        }
        $order = $order->get();
        return view('order', compact('order'));
    }
}
