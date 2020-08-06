<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    protected $fillable = ["title","product_category_id","product_key","tagline","amount","description","primary_image",
    "status","meta_title","meta_keyword","meta_description","other_images","slug","start_percentage",
    "end_percentage","range_start","range_end",'size','gender']; 
    /*
     *   $table->increments('id');

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

        // meta_title' meta_keyword' 'meta_description
     */


    //'INACTIVE','LISTED','SOLD','DELISTED','HIDE','TRIAL','OTHER'

    /*
        FOR Price Calculation 
        Base price -> products table amount field 
        Price for any fabric  -> ProductHasFabrics->amount [ multiplier ] * base price 
    */

    public function getAmountForFabric($fabric_id)
    {
        $fabric = $this->product_has_fabrics->where('fabric_id',$fabric_id)->first();

        if(!$fabric) 
            return false; 

        return $this->amount * $fabric->amount; // fabric amount -> multiplier  
    }

    public function getDiscountedPrice($type, $fabric_id, $quantity, $production_quantity, $cart_product_discount = 0)
    {

        $fabric_price = $this->getAmountForFabric($fabric_id); 

        if($fabric_price === false) 
            return ['status'=>false,'message' => "Fabric Not Allowed",'data'=>[]] ; 

        if($type != "production") {
            return ['status'=>true, 'amount' => $fabric_price ]; 
        }

        $quantity = $production_quantity; 

        if($quantity < $this->range_start) {
            $discount = 0; 
        }
        elseif ( $quantity >= $this->range_end) {
            $discount = $this->end_percentage; 
        }
        else {
            $range_divider = $this->range_end - $this->range_start; 
            $range_percentage = $this->end_percentage - $this->start_percentage;

            $discount = $this->start_percentage + ($quantity - $this->range_start ) * $range_percentage / $range_divider; 
        }

        $discount = $cart_product_discount;
        $quantity = $quantity / 3;        
        $amt =  ($quantity * $fabric_price) - ($discount / 100)  * ($quantity * $fabric_price);        

        return ['status'=>true,'amount'=>$amt];
    }

    public function category()
    {
        return $this->belongsTo(ProductCategories::class,'product_category_id','id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class,'product_id');
    }

    public function image_primary()
    {
        return $this->belongsTo(Media::class,'primary_image','id');
    }
    
    public function productColors()
    {
        return $this->hasMany(ProductColors::class,'product_id');
    }

    public function product_has_fabrics()
    {
        return $this->hasMany(ProductHasFabrics::class,'product_id','id');
    }

}
