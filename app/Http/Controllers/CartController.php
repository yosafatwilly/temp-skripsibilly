<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use Auth;
use App\Category;
use App\User;
use App\Transaction;
use Alert;

class CartController extends Controller
{
	protected $category;
	public function __construct()
	{
		$this->category = Category::where('parent_id', null)->get();
	}

	public function index(Request $req)
	{
		$product = Product::find($req->id);
		Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $req->qty, 'price' => $product->price]);
		return redirect('keranjang');
		// return Cart::content();
	}

	public function keranjang()
	{
		$category = $this->category;
		return view('homepage.keranjang', compact('category'));
	}

	public function update(Request $req)
	{
		Cart::update($req->rowid, $req->qty);
		$category = $this->category;
		return redirect('keranjang');
	}
	public function delete($rowid)
	{
		Cart::remove($rowid);
		$category = $this->category;
		return redirect('keranjang');
	}

	public function formulir()
	{
		$category = $this->category;
		return view('homepage.formulir', compact('category'));
	}

	public function transaction(Request $req)
	{
		$address = [
			'address' => $req['address'],
			'village' => $req['village']
		];
		foreach (Cart::content() as $row) {
			$product = Product::find($row->id);
			$product->stock = $product->stock - $row->qty;
			$product->save();

			$transaction = new Transaction;
			$transaction->code = date('ymdhi') . Auth::user()->id;
			$transaction->user_id = Auth::user()->id;
			$transaction->qty = $row->qty;
			$transaction->subtotal = $row->subtotal;
			$transaction->name = $req->name;
			$transaction->phone = $req->phone;
			$transaction->address = $address;
			$transaction->status_pembayaran = 'Belum Lunas';
			$transaction->ongkir = $req->ongkoskirim;
			$transaction->payment_method = $req->payment;
			$transaction->product_id = $product->id;
			$transaction->save();
			Cart::remove($row->rowId);
		}
		return redirect('cart/myorder');
	}

	public function myorder()
	{
		$category = $this->category;
		$transaction = Transaction::groupBy('code')->orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->get();
		return view('homepage.myorder', compact('category', 'transaction'));
	}

	public function detail($code)
	{
		$transaction = Transaction::groupBy('code')->orderBy('id', 'DESC')->where('code', $code)->first();
		$transactiondetail = Transaction::orderBy('id', 'DESC')->where('code', $code)->get();
		$category = $this->category;
		return view('homepage.detailtransaksi', compact('category', 'transaction', 'transactiondetail'));
	}
}
