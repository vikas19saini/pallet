<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInPaymentInits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments_init', function (Blueprint $table) {
            $table->string('payment_gateway_id')->nullable(); 
            $table->string('payment_status')->nullable()->default('INITIATED');
            $table->string('size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments_init', function (Blueprint $table) {
            $table->dropColumn(['payment_gateway_id','payment_status','size']);
        });
    }
}
