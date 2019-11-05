<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillabe = ['code', 'name', 'address', 'payment_method', 'user_id', 'product_id'];

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function product()
    {
        return $this->belongsTo('App\Product');
    }
    protected $casts = [
        'address' => 'array',
    ];
}
