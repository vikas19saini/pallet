<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->enum('salution', ['MALE', 'FEMALE', 'OTHER', 'HIDE'])->defualt('HIDE');
            $table->string('mobile')->nullable();
            $table->string('alternative_mobile')->nullable();
            $table->unsignedInteger('default_address_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {


            $table->dropColumn('salution');
            $table->dropColumn('mobile');
            $table->dropColumn('alternative_mobile');
            $table->dropColumn('default_address_id');

        });
    }
}
