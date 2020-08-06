<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductCategoriesCtrl extends Controller
{

    public function index()
    {
        $list = ProductCategories::paginate(10);
        return view('admin.product-categories.list')->with('list',$list);
    }

    public function add()
    {
        $data['statuses'] = ['ACTIVE','INACTIVE','BLOCKED','LAUNCHING','OTHER'];
        $data['category'] = null;
        return view('admin.product-categories.edit')->with($data);
    }

    public function edit(Request $request,$id)
    {
        $data['statuses'] = ['ACTIVE','INACTIVE','BLOCKED','LAUNCHING','OTHER'];
        $data['category'] = ProductCategories::with('thumnailImage')->find($id);
        return view('admin.product-categories.edit')->with($data);
    }

    public function create(Request $request)
    {
        //  name unique hona chahiye
        $name = $request->post('name');
        $nameExist = ProductCategories::where('name',$name)->first();
        if($nameExist) {
            return redirect()->back()->with('message','Name Already Exist');
        }

        $categoryExistWithSlug = ProductCategories::where('slug',$request->post('slug'))->first(); 
        if($categoryExistWithSlug) {
            return redirect()->back()->with('message','Slug Already Exist');
        }

        $category = new ProductCategories();
        $category->name  = $name;
        $category->slug  = $request->post('slug');
        $category->description  = $request->post('description');
        $category->thumbnail = $request->post('thumbnail');
        $category->status  = $request->post('status');
        $category->active = true;

        $category->meta_title = $request->post('meta_title');
        $category->meta_keyword = $request->post('meta_keyword');
        $category->meta_description = $request->post('meta_description');

        $category->save();

        return redirect('admin/product-categories');

    }

    public function update(Request $request,$id)
    {

        $name = $request->post('name');
        $nameExist = ProductCategories::where('name',$name)->first();

        if($nameExist && $nameExist->id != $id) {
            return redirect()->back()->with('message','Name Already Exist');
        }

        $categoryExistWithSlug = ProductCategories::where('slug',$request->post('slug'))->first(); 
        if($categoryExistWithSlug && $categoryExistWithSlug->id != $id) {
            return redirect()->back()->with('message','Slug Already Exist');
        }

        $category = ProductCategories::find($id);
        $category->name  = $name;
        $category->slug  = $request->post('slug');
        $category->description  = $request->post('description');
        $category->status  = $request->post('status');
        $category->thumbnail = $request->post('thumbnail');
        $category->active = true;

        $category->meta_title = $request->post('meta_title');
        $category->meta_keyword = $request->post('meta_keyword');
        $category->meta_description = $request->post('meta_description');

        $category->save();

        return redirect('admin/product-categories');
    }


}
