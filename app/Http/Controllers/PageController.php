<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $product = Product::latest()->with('category');

        if ($request->cat_slug) {
            $cat_slug = $request->cat_slug;
            $category = Category::where('slug', $cat_slug)->first();
            if ($category) {
                $product->where('category_id', $category->id)->paginate(2);
            }
        }

        if ($request->search) {
            $search =   $request->search;
            $product->where('title', 'like', "%{$search}%")->paginate(2);
        }

        if ($request->color_slug) {
            $slug = $request->color_slug;
            $color = Color::where('slug', $slug)->first();
            $product->whereHas('color', function ($query) use ($color) {
                return $query->where('color_product.color_id', $color->id);
            });
        }

        if ($request->size_slug) {
            $slug = $request->size_slug;
            $size = Size::where('slug', $slug)->first();
            $product->whereHas('size', function ($query) use ($size) {
                return $query->where('size_product.size_id', $size->id);
            });
        }

        $products = $product->paginate(2);


        $products->appends($request->all());
        $color = Color::all();
        $size = Size::all();

        return view('welcome', compact('products', 'color', 'size'));
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
