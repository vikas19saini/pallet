<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id'); 
            $table->unsignedInteger('product_id'); 
            $table->string('size')->nullable();
            $table->unsignedInteger('fabric_id'); 
            $table->unsignedInteger('quantity'); 
            $table->enum('order_type',['SAMPLE','PRODUCTION']); 
            $table->unsignedDecimal('actual_amount',11,2); 
            $table->unsignedDecimal('effective_amount',11,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
