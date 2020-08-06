<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    protected $table = "wishlist"; 

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }



}
