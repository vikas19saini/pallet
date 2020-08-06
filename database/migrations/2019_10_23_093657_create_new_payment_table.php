<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_payments', function (Blueprint $table) {
                $table->increments('id');
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
    
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_payments');
    }
}
