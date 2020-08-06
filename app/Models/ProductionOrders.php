<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class ProductionOrders extends Model
{

    static $STATUSES = ['ORDERED','DISPATCHED','PROCESSING','DELIVERED','COMPLETED','CANCELLED'];

    public function product()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function address()
    {
        return $this->belongsTo(Addresses::class,'address_id','id');
    }

}
