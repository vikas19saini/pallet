<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class ProductHasFabrics extends Model
{
    protected $table = 'product_has_fabrics'; 

    public $timestamps = false; 

    protected $fillable = ['fabric_id','product_id','amount']; 


    public function fabric()
    {
        return $this->belongsTo(Fabrics::class, 'fabric_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

}
