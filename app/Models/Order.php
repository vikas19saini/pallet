<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    

    static $STATUSES = ['ORDERED','DISPATCHED','PROCESSING','DELIVERED','COMPLETED','CANCELLED'];

    public function items()
    {
        return $this->hasMany(OrderProducts::class,'order_id','id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function address()
    {
        return $this->belongsTo(Addresses::class,'address_id','id');
    }

    /*

     $table->unsignedInteger('user_id');
            
            $table->string('payment_id')->unique();
            $table->unsignedInteger('payment_provider_id');

            $table->unsignedDecimal('total_amount',11,2);
            $table->unsignedInteger('item_count');
                        $table->unsignedInteger('currency');

            $table->enum('salution', ['MALE', 'FEMALE', 'OTHER', 'HIDE'])->default('MALE');

            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->unsignedInteger('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            
            $table->timestamp('cancelled_on')->nullable();
            $table->string('reason')->nullable();

            $table->enum('status',['ORDERED','PROCESSING','DELIVERED','COMPLETED','CANCELLED'])->default('ORDERED');

            $table->timestamps();
            */ 


}
