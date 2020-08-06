<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            
            $table->string('payment_id')->unique();
            $table->unsignedInteger('payment_provider_id');

            
            $table->unsignedDecimal('total_amount',11,2);
            $table->unsignedInteger('item_count');
            $table->string('currency');

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

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
