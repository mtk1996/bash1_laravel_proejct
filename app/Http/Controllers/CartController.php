<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::where('slug', $request->product_slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $findInCart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id);

        if ($findInCart->first()) {
            $findInCart->update([
                'quantity' => DB::raw('quantity+1')
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Added To Cart!');
    }

    public function showCart()
    {
        $cart = Cart::where('user_id', auth()->id())->with('product')->get();

        $total_qty = 0;
        foreach ($cart as $c) {
            $total_qty += $c->quantity * $c->product->price;
        }

        return view('cart', compact('cart', 'total_qty'));
    }

    public function updateCart()
    {

        Cart::where('id', request()->cart_id)->update([
            'quantity' => request()->quantity
        ]);


        return redirect()->back()->with('success', 'Changed Cart Quantity!');
    }
}
