<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillabe = ['slug','photo','name','description','stock','price','category_id'];

    function user(){
    	return $this->belongsTo('App\User');
    }
    function category(){
    	return $this->belongsTo('App\Category');
    }
    function supplier(){
    	return $this->belongsTo('App\Supplier');
    }
}
