<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    // meta_title' meta_keyword' 'meta_description

    public function thumnailImage() {
        return $this->belongsTo(Media::class,'thumbnail','id'); 
    }

    /*
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->string('active');
            $table->enum('status',['ACTIVE','INACTIVE','BLOCKED','LAUNCHING','OTHER'])->default('ACTIVE');


     */
}
