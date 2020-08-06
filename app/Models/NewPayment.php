<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class NewPayment extends Model
{

    protected $table = "new_payments"; 

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Products','product_id','id');
    }

    public function paymentProvider()
    {
       return $this->belongsTo('App\Models\PaymentProviders', 'payment_provider_id', 'id');
    }

    public function paymentProducts()
    {
        return $this->hasMany('App\Models\NewPaymentProducts','new_payment_id','id'); 
    }

    /*
        $table->unsignedInteger('user_id'); 
        $table->unsignedInteger('payment_provider_id'); 
        $table->unsignedDecimal('total_amount', 10, 2);
        $table->unsignedDecimal('products_amount',10,2); 
        $table->unsignedDecimal('shipping_amount', 10, 2); 
        $table->unsignedInteger('item_count'); 
        $table->string('currency'); 
        $table->string('shipping_status')->default('PLACED')->nullable();
        $table->string('payment_gateway_id')->nullable(); 
        $table->string('payment_status')->nullable();
    */

}
