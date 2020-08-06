<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class PaymentProviders extends Model
{

    protected $table = "payment_providers"; 

    /*
        $table->increments('id');
        $table->string('name'); 
        $table->string('slug')->unique(); 
        $table->tinyInteger('active');
        $table->timestamps();
    */

}
