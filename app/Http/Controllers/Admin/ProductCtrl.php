<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\ProductCategories;
use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductColors; 
use App\Models\Fabrics;
use App\Models\ProductHasFabrics; 

class ProductCtrl extends Controller
{

    public function index(Request $request)
    {
        $products = Products::paginate(10);
        return view('admin.products.list')->with('products',$products);
    }

    public function add(Request $request)
    {
        $data['product'] = '';
        $data['fabrics'] = Fabrics::where('active',1)->get(); 
        $data['categories'] = ProductCategories::all();
        $data['statuses'] = ['INACTIVE','LISTED','SOLD','DELISTED','HIDE','TRIAL','OTHER'];
        return view('admin.products.edit')->with($data);
    }

    public function edit(Request $request,$id)
    {
        $data['product'] = Products::with('product_has_fabrics','productImages','image_primary','productColors')->find($id);
        $data['categories'] = ProductCategories::all();
        $data['statuses'] = ['INACTIVE','LISTED','SOLD','DELISTED','HIDE','TRIAL','OTHER'];
        $data['fabrics'] = Fabrics::where('active',1)->get(); 

        if($data['product']->other_images)
        {
            $exploded = explode(",",$data['product']->other_images);
            if( count($exploded) && is_string($exploded[0]) ) {
                $data['productImages'] = [];
            }
            else {
                $data['productImages'] = Media::whereRaw('id in ('.$data['product']->other_images.' ) ')->get();
            }
        }
        else
            $data['productImages'] = [];

//        $data['productImages'] = Media::whereRaw('id in ('.$data['product']->other_images.' ) ')->get();
        return view('admin.products.edit')->with($data);
    }

    public function store(Request $request)
    {
        $price = $request->post('price'); 
        $fabrics = Fabrics::whereIn('id',array_keys($price))->get();
        $priceArray = []; 
        foreach($fabrics as $k=>$v) { 
            if( !(isset($request->post('price')[$v->id]) && 
                is_numeric($request->post('price')[$v->id])
            )) {
                continue; 
                // return redirect()->back()->with('message','Price should be numeric only');
            }

            $tempFabric = new ProductHasFabrics;
            $tempFabric->fabric_id = $v->id;
            $tempFabric->amount = $price[$v->id];
            $priceArray[$k] = $tempFabric;
        }  

        $productExistWithSlug = Products::where('slug',$request->post('slug'))->first();
        if($productExistWithSlug) {
            return redirect()->back()->with('message','Slug Already Exist');
        }

        $product = new Products;
        $product->slug = $request->post('slug'); 
        $product->title = $request->post('title');
        $product->tagline = $request->post('tagline');
        $product->amount = $request->post('amount');
        $product->product_key = $request->post('product_key');
        $product->product_category_id = $request->post('category');
        $product->status = $request->post('status');

        $product->start_percentage = $request->post('start_percentage'); 
        $product->end_percentage = $request->post('end_percentage');
        $product->range_start = $request->post('range_start'); 
        $product->range_end = $request->post('range_end'); 

        $product->meta_title = $request->post('meta_title');
        $product->meta_keyword = $request->post('meta_keyword');
        $product->meta_description = $request->post('meta_description');


        if($request->has('primary_image'))
        {
            $product->primary_image = $request->post('primary_image');
//            $name = "p-".str_random(3)."-".time().".png";
//            $request->file('primary_image')->storeAs('public/products',$name);
//            $product->primary_image = "storage/products/".$name;
        }
        else
        {
            return redirect()->back()->with('message','Image is necessary');
        }

        $product->other_images = $request->post('other_images');
        $product->description = $request->post('description');
        $product->save();

        foreach($priceArray as $item) {
            $item->product_id = $product->id; 
            $item->save();
        }

        return redirect('admin/products');
    }

    public function update(Request $request,$id)
    {

        $price = $request->post('price');

        // $fabrics = Fabrics::whereIn('id',array_keys($price))->get();
        $priceArray = []; 
        foreach($price as  $k=>$v) { 
            if(!is_numeric($v)) {
                continue; 
                return redirect()->back()->with('message','Price should be numeric only');
            }
            if($v < 1)
                continue; 
            $tempFabric = new ProductHasFabrics;
            $tempFabric->product_id = $id;
            $tempFabric->fabric_id = $k;
            $tempFabric->amount = $v; 
            $priceArray[$k] = $tempFabric;
        }  

        $productExistWithSlug = Products::where('slug',$request->post('slug'))->first();
        if($productExistWithSlug && $productExistWithSlug->id != $id) {
            return redirect()->back()->with('message','Slug Already Exist');
        }

        $product = Products::find($id);

        $product->title = $request->post('title');
        $product->tagline = $request->post('tagline');
        $product->amount = $request->post('amount');
        $product->product_key = $request->post('product_key');
        $product->product_category_id = $request->post('category');
        $product->status = $request->post('status');

        $product->meta_title = $request->post('meta_title');
        $product->meta_keyword = $request->post('meta_keyword');
        $product->meta_description = $request->post('meta_description');

        $product->start_percentage = $request->post('start_percentage'); 
        $product->end_percentage = $request->post('end_percentage');
        $product->range_start = $request->post('range_start'); 
        $product->range_end = $request->post('range_end'); 

        $oldImage = '';
        if($request->has('primary_image'))
        {
            $product->primary_image = $request->post('primary_image');
//            $name = "p-".str_random(3)."-".time().".png";
//            $request->file('primary_image')->storeAs('public/products',$name);
//            $oldImage = $product->primary_image;
//            $product->primary_image = "storage/products/".$name;
        }

        $product->slug = $request->post('slug'); 
        $product->description = $request->post('description');
        $otherImages = implode(',',$request->post('multi_select'));
        $product->other_images = $otherImages; //$request->post('other_images');
        $product->save();

        ProductHasFabrics::where('product_id',$product->id)->delete(); 
        foreach($priceArray as $item)
            $item->save();

        if( $oldImage )
            unlink(public_path($oldImage));

        $images = ['image_1','image_2','image_3','image_4'];
//        foreach ($images as $image)
//        {
//            if($request->has($image))
//            {
//                $name = "p-".str_random(3)."-".time().".png";
//                $request->file($image)->storeAs('public/products',$name);
//                $product->primary_image = "storage/products/".$name;
//                $productImages = new ProductImages();
//                $productImages->product_id = $product->id;
//                $productImages->image = "storage/products/".$name;
//                $productImages->save();
//            }
//        }


        return redirect('admin/products');

    }


    public function addColor(Request $request,$productId)
    {
        $color = $request->post('color'); 
        $exist = ProductColors::where('color_code',$color)->where('product_id',$productId)->first(); 

        if($exist)
            return ['status'=>true]; 

        $productColor = new ProductColors; 
        $productColor->product_id = $productId; 
        $productColor->color_code = $color; 

        $productColor->save(); 

        return ['status'=>true]; 

    }

    public function deleteColor(Request $request,$productId,$colorId)
    {
        $color = $request->post('color'); 
        $exist = ProductColors::find($colorId); 
        // where('color_code',$color)->where('product_id',$productId)->where('id',$colorId)->first(); 

        if( $exist && $exist->product_id == $productId)
        {
            $exist->delete(); 
        }
        else 
        {
            // return ['status'=>false]; 
            abort(404);
        }
        return ['status'=>true];  
    }

    public function searchCategory(Request $request,$catId)
    {
        
    }
}
