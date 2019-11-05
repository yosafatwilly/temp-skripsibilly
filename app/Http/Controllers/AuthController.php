<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use Alert;
use Auth;

class AuthController extends Controller
{
    protected $category;
    public function __construct()
    {
        $this->category = Category::where('parent_id', null)->get();
    }

    public function register()
    {
        $category = $this->category;
        return view('homepage.register', compact('category'));
    }
    protected function store(Request $data)
    {
        $address = [
            'address' => $data['address'], 
            'village' => $data['village']
        ];

        $remember_token = base64_encode($data['email']);
        $mydata =  [
            'name' => $data['name'],
            'email' => $data['email'],
            'username'  => $data['username'],
            'address'   => $data['address'],
            'address'   => $address,
            'phone'     => $data['phone'],
            'gender'    => $data['gender'],
            'birthday'  => $data['birthday'],
            'role'      => 'member',
            'password' => bcrypt($data['password']),
            'remember_token' => $remember_token,
        ];
        User::create($mydata);
        Alert::success('', 'Pendaftaran selesai');
        return redirect('/');
    }

    public function login(Request $request)
    {
        $email =  $request->email;
        $pwd   =  $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $pwd])) {
            return redirect('/');
        } else {
            Alert::success('', 'Maaf Email atau password tidak sesuai');
            return redirect()->back();
        }
    }
}
