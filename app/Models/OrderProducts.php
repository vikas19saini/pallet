<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $table = "order_products";

    public $timestamps = false; 


    public function product()
    {
        return $this->belongsTo('App\Models\Products','product_id','id');
    }

}

/*
  $table->increments('id');
            $table->unsignedInteger('order_id'); 
            $table->unsignedInteger('product_id'); 
            $table->string('size')->nullable();
            $table->unsignedInteger('fabric_id'); 
            $table->unsignedInteger('quantity'); 
            $table->enum('order_type',['SAMPLE','PRODUCTION']); 
            $table->unsignedDecimal('actual_amount',11,2); 
            $table->unsignedDecimal('effective_amount',11,2);
            */ 