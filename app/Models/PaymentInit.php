<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class PaymentInit extends Model
{

    protected $table = "payments_init"; 

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

    /*
        $table->unsignedInteger('user_id'); 
        $table->unsignedInteger('payment_provider_id'); 
        $table->string('tid')->nullable(); 

        $table->unsignedDecimal('total_amount', 10, 2);
        $table->unsignedDecimal('tax', 10, 2);
        $table->unsignedDecimal('shipping', 10, 2); 

        $table->string('currency'); 
        $table->unsignedInteger('cart_id')->nullable(); // for future scope
        $table->unsignedInteger('product_id')->nullable(); // for compatibility 

        $table->string('shipping_status')->default('PLACED')->nullable();


        ---  alter migration 
            $table->string('payment_gateway_id')->nullable(); 
            $table->string('payment_status')->nullable()->default('INITIATED');

    */

}
