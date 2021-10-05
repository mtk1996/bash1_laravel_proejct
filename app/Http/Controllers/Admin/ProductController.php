<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->paginate(10);
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =  Category::all();
        $size = Size::all();
        $color = Color::all();
        return view('admin.product.create', compact('category', 'size', 'color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'total_quantity' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => "required|mimes:jpg,png,webp|max:1024"
        ]);

        $file = $request->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);


        $product = Product::create([
            'slug' => Str::slug(uniqid() . $request->title),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $file_name,
            'total_quantity' => $request->total_quantity,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $product->color()->sync($request->color_id);
        $product->size()->sync($request->size_id);
        return redirect()->back()->with('success', 'Creted Success!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->with('color', 'size', 'category')->first();

        $category =  Category::all();
        $size = Size::all();
        $color = Color::all();
        if ($product) {
            return view('admin.product.edit', compact('product', 'category', 'size', 'color'));
        }
        return redirect()->back()->with('danger', 'Product Not Found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product =  Product::where('id', $id);

        if ($request->file('image')) {
            File::delete(public_path('images/' . $product->first()->image));
            $file = $request->file('image');
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
        } else {
            $file_name =  $product->first()->image;
        }

        $product->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $file_name,
            'total_quantity' => $request->total_quantity,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $product = Product::find($product->first()->id);
        $product->color()->sync($request->color_id);
        $product->size()->sync($request->size_id);
        return redirect()->back()->with('success', 'updated success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id);

        File::delete(public_path('/images/' . $product->first()->image));
        $product->delete();
        return redirect()->back()->with('success', 'deleted success');
    }
}
