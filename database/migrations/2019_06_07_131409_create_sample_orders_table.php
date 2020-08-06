<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');

            $table->unsignedInteger('product_id');
            $table->unsignedDecimal('amount',11,2);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('address_id');
            $table->string('size')->nullable();
            $table->string('payment_id')->nullable();


            $table->timestamp('cancelled_on')->nullable();

            $table->enum('status',['ORDERED','PROCESSING','DELIVERED','COMPLETED','CANCELLED'])->default('ORDERED');

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
        Schema::dropIfExists('sample_orders');
    }
}
