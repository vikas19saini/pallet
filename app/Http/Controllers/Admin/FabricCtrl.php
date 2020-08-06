<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fabrics;
use Illuminate\Http\Request;

class FabricCtrl extends Controller
{

    public function index(Request $request)
    {
        $list = Fabrics::paginate(); 
        return view('admin.fabrics.list')->with('list',$list);  
    }

    public function add(Request $request)
    {
        $fabric = null; 
        return view('admin.fabrics.add')->with('fabric',$fabric);   
    }

    public function create(Request $request)
    {
        $fabric = new Fabrics;
        $fabric->name = $request->post('name'); 
        $fabric->code = $request->post('code'); 
        $fabric->active = $request->post('active');

        $fabric->weight = $request->post('weight'); 
        $fabric->content = $request->post('content'); 
        $fabric->gsm = $request->post('gsm'); 
        $fabric->construction = $request->post('construction'); 
        $fabric->count = $request->post('count'); 
        $fabric->certification = $request->post('certification'); 
        $fabric->usability = $request->post('usability');

        $fabric->save(); 
        
        return redirect('admin/fabrics'); 
    }


    public function update(Request $request,$fabricId)
    {
        $fabric = Fabrics::find($fabricId);
        if(!$fabric)
            return redirect()->back(); 

        $fabric->name = $request->post('name'); 
        $fabric->code = $request->post('code'); 
        $fabric->active = $request->post('active');


        $fabric->weight = $request->post('weight'); 
        $fabric->content = $request->post('content'); 
        $fabric->gsm = $request->post('gsm'); 
        $fabric->construction = $request->post('construction'); 
        $fabric->count = $request->post('count'); 
        $fabric->certification = $request->post('certification'); 
        $fabric->usability = $request->post('usability');              


        $fabric->save(); 

        return redirect('admin/fabrics');

    }

    public function edit(Request $request,$fabricId)
    {
        $fabric = Fabrics::find($fabricId);
        if(!$fabric)
            return redirect()->back(); 

        return view('admin.fabrics.add')->with('fabric',$fabric);
    }



}
