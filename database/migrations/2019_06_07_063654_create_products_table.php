<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_category_id');
            $table->string('product_key');
            $table->string('title');
            $table->string('tagline');
            $table->decimal('amount',11,2);
            $table->text('description');
            $table->string('primary_image');


            $table->unsignedInteger('user_id')->nullable();
            $table->timestamp('delisted_from')->nullable();
            $table->timestamp('sold_on')->nullable();

            $table->enum('status',['INACTIVE','LISTED','SOLD','DELISTED','HIDE','TRIAL','OTHER'])->default('INACTIVE');
            $table->timestamps();
        });

        //    images: [String],
        // colorAvailable

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
