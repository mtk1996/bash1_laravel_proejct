<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApi extends Controller
{
    public function showOrderlist()
    {
        $user  =  auth()->guard('api')->user();
        $order  = Order::where('user_id', $user->id)->paginate(12);
        return response()->json([
            'success' => true,
            'status' => 200,
            'data' => $order,
        ]);
    }
}
