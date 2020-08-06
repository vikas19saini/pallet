<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForCart extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->unsignedDecimal('amount',11,2);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('address_id')->nullable();
            $table->unsignedInteger('fabric_id');
            $table->string('size')->nullable();
            $table->enum('order_type',['SAMPLE','PRODUCTION'])->default('SAMPLE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn(['amount','quantity','address_id','size','fabric_id','order_type']);
        });
    }
}
