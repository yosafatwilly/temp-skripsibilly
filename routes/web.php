<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'BerandaController@index');
Route::get('/product', 'BerandaController@product');
Route::get('/category/{slug}','BerandaController@productbycategory')->name('category.product');
Route::get('product/detail/{slug}','BerandaController@detail');
Route::get('myprofil','BerandaController@myprofil');
Route::post('updateprofil','BerandaController@updateprofil');
Route::get('logout','BerandaController@logout');

//auth
Route::get('auth/register','AuthController@register');
Route::post('auth/register','AuthController@store')->name('home.register');
Route::get('verfikasi/register/{token}','AuthController@verif');
Route::post('auth/login','AuthController@login');
Auth::routes();

//cart
Route::post('/cart','CartController@index');
Route::get('keranjang','CartController@keranjang');
Route::post('cart/update','CartController@update');
Route::get('cart/delete/{rowid}','CartController@delete');
Route::get('cart/formulir','CartController@formulir');
Route::get('checkongkir/{tujuan}',function($tujuan){
	return checkongkir($tujuan);
});
Route::post('cart/transaction','CartController@transaction');
Route::get('cart/myorder','CartController@myorder');
Route::get('cart/detail/{code}','CartController@detail');

Route::prefix('admin')->middleware(['auth','oauth:admin'])->group(function(){
    Route::get('media', 'HomeController@media')->name('media.index');
    Route::get('dashboard', 'HomeController@index');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('supplier', 'SupplierController');

    //transaction
    // Route::get('transaction','TransactionController@index')->name('transaction.index');
    Route::resource('transaction', 'TransactionController');
    Route::get('transaction/s/{code}/{status}','TransactionController@status')->name('transaction.status');
    Route::get('transaction/c/{code}','TransactionController@cetakpdf')->name('transaction.cetakpdf');

    //user
    Route::resource('user', 'UserController');
	Route::get('user/status/{id}','UserController@changestatus')->name('user.changestatus');
}); 