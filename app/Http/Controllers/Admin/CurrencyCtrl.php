<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currencies;
use Illuminate\Http\Request;

class CurrencyCtrl extends Controller
{

    public function index(Request $request)
    {
        $data['list'] = Currencies::all();
        return view('admin.currency.index')->with($data);
    }

    public function add()
    {
        $data['currency'] = null;
        return view('admin.currency.edit')->with($data);
    }

    public function create(Request $request)
    {
        $currency = new Currencies;
        $currency->currency = $request->post('currency');
        $currency->country = $request->post('country');
        $currency->active = 1;
        $currency->conversion_factor = $request->post('conversion_factor'); 
        $currency->is_primary = $request->post('is_primary') == "on" ? 1 : 0; 

        $currency->save();

        if($currency->is_primary) {
            self::makeThisCurrencyPrimary($currency); 
        }
        // dd($request->all());  


        return redirect('admin/currencies');
    }

    public static function makeThisCurrencyPrimary($currency)
    {
        $primary = Currencies::where('is_primary',1)->first();
        // dd([$primary,$currency]);
        if($primary && $primary->id != $currency->id ) {
            return redirect()->back()->with('message',"Can't make currency primary");
        }
        else {
            $currency->is_primary = 1; 
            $currency->save(); 
        }
        
        return redirect('admin/currencies');
    }

    public function edit(Request $request,$id)
    {
        $data['currency'] = Currencies::find($id);
        return view('admin.currency.edit')->with($data);
    }


    public function update(Request $request,$id)
    {
        $currency = Currencies::find($id);
        $currency->currency = $request->post('currency');
        $currency->country = $request->post('country');
        $currency->active = $request->post('active');


        $currency->conversion_factor = $request->post('conversion_factor'); 
        $is_primary = $request->post('is_primary')=="on" ? 1 : 0; 

        $currency->save();

        if($is_primary) {
            return self::makeThisCurrencyPrimary($currency); 
        }


        return redirect('admin/currencies');
    }

    public function delete($id)
    {
        $currency = Currencies::find($id); 
        if(!$currency) 
            return response()->json([
                'status' => false,
                'message' => "Unable to deleted Media"
            ]); 

        $currency->delete(); 
        return response()->json([
            'status' => true
        ]); 

    }


}
