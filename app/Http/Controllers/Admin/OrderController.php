<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::latest()->with('product', 'user')->paginate(10);
        return view('admin.order.index', compact('order'));
    }
    public function change()
    {
        $status = request()->status;
        $order_id = request()->order_id;
        Order::where('id', $order_id)->update([
            'status' => $status
        ]);
        return redirect()->back()->with('success', 'Change Order Status Success');
    }
}
