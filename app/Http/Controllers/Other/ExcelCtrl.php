<?php

namespace App\Http\Controllers\Other;

use App\Models\Cart;
use App\Models\Products;
use App\Models\Media;
use App\Models\ProductHasFabrics;
use App\Models\ProductImages;
use App\Models\Fabrics;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth;
use App\User;
use \Maatwebsite\Excel\Facades\Excel;
use App\imports\ProductsImport;

class ExcelCtrl extends Controller
{

    public function show_test()
    {
        // $list = Fabrics::whereIn('name',['aa','cvb','code'])->get(); 
        // return $list->where('name','aa')->first();

        return view('upload.test');
    }

    public function convertExcelRowToRecord($field)
    {
        $fields = [
            'title', 'product_category', 'product_key', "short_description", "amount", "description",
            "primary_image", "status", "other_images",
            "slug", "start_percentage" => 20, "end_percentage" => 82, "range_start" => 20, "range_end" => 42,
            "fabric_names", "fabric_multiplier" => 1, "size", "dimension", 'how_upcycle', 'total_created', 'total_quantity', 'video'
        ];

        $row = new Products;
        foreach ($fields as $k => $v) {
            if (is_numeric($k)) {
                $row->{$fields[$k]} = $field[$v];
            } else {
                $row->{$k} = $v;
            }
        }

        $row->tagline = $row->short_description;
        unset($row->short_description);
        unset($row->fabric_names);
        unset($row->fabric_multiplier);

        // $row->product_key = time()."-". rand(0,1000)."-".rand(100,10000); 
        $row->slug  = $row->product_key;

        $row->amount = trim(explode(" ", $row->amount)[0]);

        // $row->product_category_id = $row->product_category;  
        $row->product_category_id = ProductCategories::where('name', ucfirst($row->product_category))->first()->id;

        unset($row->product_category);

        $row->status = "LISTED";

        return $row;
    }

    public function test(Request $request)
    {
        $upload_url = "upload/excel/test";
        $rules = array(
            'excel' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        // process the form
        if ($validator->fails()) {
            return Redirect::to($upload_url)->withErrors($validator);
        } else {
            // $name = "'file-upload-'.time().".".$request->excel->getClientOriginalExtension()";
            // $request->excel->storeAs('uploads', $name);  

            // try {
            // $path = storage_path('app/uploads/'.$name);
            $product = Products::first();

            $list = Excel::toArray(new ProductsImport, $request->file('excel'));

            $item = $list[0][0];
            foreach ($list[0] as $items) {
                // dd($list[0][1]);
                $singleRow = self::convertExcelRowToRecord($items);
                $singleRow->save();

                $fabric_names = explode(",", $item['fabric_names']);
                $fabric_multiplier = explode(",", $item['fabric_multiplier']);
                if (count($fabric_names) != count($fabric_multiplier)) {
                    dd("Fabric name and multiplier not match");
                }

                foreach ($fabric_names as $k => $v) {
                    $productHasFabrics = new ProductHasFabrics;
                    $productHasFabrics->product_id = $singleRow->id;
                    $productHasFabrics->amount = trim($fabric_multiplier[$k]);
                    $productHasFabrics->fabric_id = Fabrics::where('name', $v)->first()->id;
                    $productHasFabrics->save();
                }
            }

            \Session::flash('success', 'Users uploaded successfully.');

            return response()->json([
                'status' => true,
                "message" => "Upload Done"
            ]);


            $record = self::convertProductExcel($item);

            $product =  Products::create($record['product']);

            foreach ($record['product_has_fabrics'] as $k => $item) {
                $record['product_has_fabrics'][$k]['product_id'] = $product->id;
            }

            ProductHasFabrics::insert($record['product_has_fabrics']);

            \Session::flash('success', 'Users uploaded successfully.');

            return response()->json([
                'status' => true,
                "message" => "Upload Done"
            ]);
            // return redirect(route('users.index'));
            // } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return response()->json($e->getMessage());
            // }
        }
    }

    public static function convertProductExcelArray(array $productArray)
    {
    }

    public static function convertProductExcel($product)
    {

        //  need to fetch 
        //  fabrics_name, fabrics_multiplier 


        $arr =  [
            'title' => $product['title'],
            'product_key' => $product['product_key'],
            'tagline' => $product['short_description'],
            'amount' => $product['amount'],
            'description' => $product['description'],
            'meta_title' => $product['meta_title'],
            'meta_keyword' => $product['meta_keyword'],
            'meta_description' => $product['meta_description'],
            'slug' => $product['slug'],

            'start_percentage' => $product['start_percentage'],
            'end_percentage' => $product['end_percentage'],
            'range_start' => $product['range_start'],
            'range_end' => $product['range_end'],
            'size' => trim($product['size']),
            'gender' => $product['gender'],
            'primary_image' => "123a",
            'status' => 'LISTED',
        ];

        $product_category = ProductCategories::where('name', 'like', '%' . $product['product_category'] . '%')->first();
        $arr['product_category_id'] = $product_category->id;


        $primary_image = Media::where('title', 'like', '%' . $product['primary_image'] . '%')->first();
        $arr['primary_image'] = $primary_image ? $primary_image->id : 'no-image';


        // for fabric prices 
        $fabric_name_arr = explode(',', $product['fabric_names']);
        $fabrics = Fabrics::whereIn('name', $fabric_name_arr)->get();
        $fabrics_price = explode(',', $product['fabric_multiplier']);

        $fabris_arr = [];
        foreach ($fabric_name_arr as $k => $item) {

            $fabric_obj = $fabrics;
            $fabric_obj = $fabric_obj->where('name', trim($item))->first();

            $fabris_arr[] = [
                'fabric_id' => $fabric_obj->id,
                'amount' => $fabrics_price[$k]
            ];
        }

        $images_arr = [];
        $images = Media::whereIn('title', explode(',', $product['other_images']))->get();
        foreach ($images as $k)
            $images_arr[] =  $k->id; // ['media_id'=>$k->id]; 

        $arr['other_images'] = implode(',', $images_arr);

        return  [
            'product' => $arr,
            'product_has_fabrics' => $fabris_arr,
        ];
    }
}
