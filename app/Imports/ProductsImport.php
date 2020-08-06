<?php

   

namespace App\Imports;

   

use App\User;
use App\Models\Products; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;    

class ProductsImport implements ToModel, WithHeadingRow

{

    /** 
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $fields = ['title','product_category_id','product_key', "short_description", "amount", "description",
        "primary_image", "status", "meta_title", "meta_keyword", "meta_description", "other_images",
         "slug", "start_percentage"=>20, "end_percentage"=>82, "range_start"=>20, "range_end"=>42,
          "fabric_names", "fabric_multiplier"=>1, "size", "gender"]; 

        foreach($fields as $k=>$v) 
        {
            if(is_numeric($k))
            {

            }
            else
            {

            }

        }
        
        return new Products([
                'name'  => $single_row['orderdate'],
            ]);

    }

}