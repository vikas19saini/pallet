<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            
            $table->unsignedDecimal('start_percentage', 8, 2)->nullable();
            $table->unsignedDecimal('end_percentage', 8, 2)->nullable();
            $table->unsignedDecimal('range_start', 8, 2)->nullable();
            $table->unsignedDecimal('range_end', 8, 2)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['start_percentage','end_percentage','range_start','range_end']);
        });
    }
}
