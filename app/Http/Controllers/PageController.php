<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $product = Product::latest()->with('category');

        $products = null;

        if ($request->cat_slug) {
            $cat_slug = $request->cat_slug;
            $category = Category::where('slug', $cat_slug)->first();
            if ($category) {
                $products  = $product->where('category_id', $category->id)->paginate(2);
            }
        } else if ($request->search) {
            $search =   $request->search;
            $products = $product->where('title', 'like', "%{$search}%")->paginate(2);
        } else {
            $products = $product->paginate(2);
        }

        $products->appends($request->all());

        return view('welcome', compact('products'));
    }

    public function productDetail($slug)
    {
        $p = Product::where('slug', $slug)->with('category', 'size', 'color')->first();
        if ($p) {
            return view('product_detail', compact('p'));
        }
        return redirect()->back();
    }
}
