<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewPaymentProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_payment_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id'); 
            $table->unsignedInteger('new_payment_id'); // payment ref
            $table->unsignedDecimal('effective_amount', 10, 2);
            $table->unsignedDecimal('actual_amount', 10, 2);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('fabric_id');
            $table->enum('order_type',['SAMPLE','PRODUCTION']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_payment_products');
    }
}
