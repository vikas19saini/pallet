<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class NewPaymentProducts extends Model
{
    protected $table = "new_payment_products"; 

    public $timestamps = false; 

    public function payment()
    {
        return $this->belongsTo('App\Models\NewPayment','new_payment_id','id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Products','product_id','id');
    }

    /*
            $table->increments('id');
            $table->unsignedInteger('product_id'); 
            $table->unsignedInteger('new_payment_id'); // payment ref
            $table->unsignedDecimal('effective_amount', 10, 2);
            $table->unsignedDecimal('actual_amount', 10, 2);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('fabric_id');
            $table->enum('order_type',['SAMPLE','PRODUCTION']);
    */

}
