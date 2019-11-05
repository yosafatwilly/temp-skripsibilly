<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::where('parent_id', null)->get();
        $suppliers = Supplier::all();
        return view('admin.product.add', compact('categorys', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $request->file('file')->move('static/dist/img/', $filename);
        $product = new Product;
        $product->slug = $request->slug;
        $product->photo = 'static/dist/img/' . $filename;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->save();
        Alert::success('', 'Product Berhasil di Tambahkan');
        return redirect('admin/product');
        // dd($request);
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
        $product = Product::find($id);
        $categorys = Category::where('parent_id', null)->get();
        $suppliers = Supplier::all();
        return view('admin.product.edit', compact('product', 'categorys', 'suppliers'));
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
        if ($file = $request->file('file')) {
            $filename = $file->getClientOriginalName();
            $request->file('file')->move('static/dist/img/', $filename);
            $img = 'static/dist/img/' . $filename;
        } else {
            $img = $request->tmp_image;
        }
        $product = Product::find($id);
        $product->slug = $request->slug;
        $product->photo = $img;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->save();
        Alert::success('', 'Product Berhasil di Update');
        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        Alert::success('', 'Product Berhasil di delete');
        return redirect('admin/product');
    }
}
