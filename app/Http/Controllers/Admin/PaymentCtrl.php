<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Log;

use App\Models\Products; 
use App\Models\PaymentInit; 
use App\User;


class PaymentCtrl extends Controller
{

    public function index()
    {
        $arr =  PaymentInit::with('paymentProvider','user','product')->paginate(10);
        // return $arr[0];
        return view('admin.payments.index')->with('payments',$arr); 
    }

}