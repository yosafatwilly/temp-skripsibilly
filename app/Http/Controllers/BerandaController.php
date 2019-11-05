<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\User;
use Auth;
use Alert;

class BerandaController extends Controller
{
    protected $category;
    public function __construct()
    {
        $this->category = Category::where('parent_id', null)->get();
    }

    public function index()
    {
        $category = $this->category;
        $products = Product::take(12)->orderBy('id', 'DESC')->get();
        return view('homepage.index', compact('products', 'category'));
    }

    public function product()
    {
        $category = $this->category;
        $products = Product::orderBy('id', 'DESC')->paginate(8);
        return view('homepage.product', compact('products', 'category'));
    }

    public function productbycategory($slug)
    {
        $categorys = Category::where('slug', $slug)->first();
        $category = $this->category;
        $name       = $categorys->name;
        if ($categorys->parent_id == null) {
            $listId = $categorys->children->pluck('id')->toArray();
            $products = Product::orderBy('id', 'DESC')->whereIn('category_id', $listId)->paginate(8);
        } else {
            $id       = $categorys->id;
            $products = Product::orderBy('id', 'DESC')->where('category_id', $id)->paginate(8);
        }
        return view('homepage.productbycategory', compact('products', 'category', 'name'));
    }

    public function detail($slug)
    {
        $products = Product::where('slug', $slug)->first();
        $category = $this->category;
        return view('homepage.detail', compact('products', 'category'));
    }

    public function myprofil()
    {
        $category = $this->category;
        $user  = User::where('id', Auth::user()->id)->first();
        return view('homepage.myprofil', compact('category', 'user'));
    }
    public function updateprofil(Request $data)
    {
        $address = [
			'address' => $data['address'],
			'village' => $data['village']
        ];
        
        if ($file = $data->file('file')) {
            $filename = $file->getClientOriginalName();
            $data->file('file')->move('static/dist/img/', $filename);
            $img = 'static/dist/img/' . $filename;
        } else {
            $img = $data->tmp_image;
        }

        $mydata = [
            'name' => $data['name'],
            'email' => $data['email'],
            'username'  => $data['username'],
            'address'  => json_encode($address),
            'phone'     => $data['phone'],
            'gender'    => $data['gender'],
            'birthday'  => $data['birthday'],
            'role'      => $data['role'],
            'photo'     => $img,
            'password' => bcrypt($data['password']),
        ];
        User::where('id', $data->id)->update($mydata);
        Alert::success('', 'Profil  berhasil di perbarui');
        return redirect('myprofil');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
