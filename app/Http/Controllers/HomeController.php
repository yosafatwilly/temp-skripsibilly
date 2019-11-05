<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\User;
use App\Transaction;
use App\Supplier;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = Category::all();
        $user = User::all();
        $product = Product::all();
        $transaction = Transaction::all();
        $supplier = Supplier::all();
        return view('admin.dashboard',compact('category','user','product','transaction', 'supplier'));
    }

    public function media(){
    
        return view('admin.media');
    }
}
