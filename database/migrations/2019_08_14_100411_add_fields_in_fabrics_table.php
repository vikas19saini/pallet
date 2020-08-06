<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInFabricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fabric_types', function (Blueprint $table) {
            $table->string('content')->nullable();
            $table->integer('gsm')->nullable(); 
            $table->string('count')->nullable(); 
            $table->string('construction')->nullable(); 
            $table->string('certification')->nullable(); 
            $table->string('usability')->nullable();
            $table->integer('weight')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fabric_types', function (Blueprint $table) {
            $table->dropColumn(['content','gsm','count','construction','certification','usability','weight']);
        });
    }
}
