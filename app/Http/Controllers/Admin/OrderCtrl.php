<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductionOrders;
use App\Models\SampleOrders;
use Illuminate\Http\Request;

class OrderCtrl extends Controller
{

    public function index(Request $request,$type)
    {
        $data['type'] = $type;
        if($type == "sample")
            $data['orders'] = SampleOrders::paginate();
        else
            $data['orders'] = ProductionOrders::paginate();

        return view('admin.orders.list')->with($data);
    }

    public function show(Request $request,$type,$id)
    {
        $data['type'] = $type;
        if($type == "sample")
            $data['order'] = SampleOrders::with('user','address','product')->find($id);
        else
            $data['order'] = ProductionOrders::with('user','address','product')->find($id);

        $data['statutes'] = ProductionOrders::$STATUSES;
//        return $data['order'];
        return view('admin.orders.show')->with($data);
    }

}
