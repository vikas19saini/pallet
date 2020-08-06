<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsInitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_init', function (Blueprint $table) {
            $table->increments('id');
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

            $table->string('payment_gateway_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('size')->nullable(); 

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
        Schema::dropIfExists('payments_init');
    }
}
