<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressFieldsInOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_orders', function (Blueprint $table) {
            $table->enum('salution', ['MALE', 'FEMALE', 'OTHER', 'HIDE'])->default('MALE');

            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->unsignedInteger('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
        });

        Schema::table('sample_orders', function (Blueprint $table) {
            $table->enum('salution', ['MALE', 'FEMALE', 'OTHER', 'HIDE'])->default('MALE');

            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->unsignedInteger('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_orders', function (Blueprint $table) {
            $table->dropColumn(['salution','name','address','city','zipcode','country','state']); 
        });

        Schema::table('sample_orders', function (Blueprint $table) {
            $table->dropColumn(['salution','name','address','city','zipcode','country','state']); 
        });
    }
}
