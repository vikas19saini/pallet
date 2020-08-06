<?php

namespace App\Http\Controllers;


use App\Models\Addresses;
use App\Models\ProductionOrders;
use App\Models\Products;
use App\Models\SampleOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Models\Countries; 
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderProducts; 
use App\Models\NewPaymentProducts; 
use App\Models\NewPayment; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Event;
use App\Events\EventSendMail;

use App\Http\Controllers\Payments\PaypalCtrl; 

class NewOrderCtrl extends Controller
{

    public function viewByType(Request $request,$type='')
    {
        $data = ['type' => $type];
        $data['order_list'] = Order::with('items.product')->where('user_id',Auth::id())->orderBy('id','desc')->paginate();
        return view('pages.order')->with($data);
    }

    public function index(Request $request)
    {
        // $paymentInit = NewPayment::with('paymentProducts')->where('payment_gateway_id','EC-87899044DF947193Y')->first(); 
        // return $paymentInit;
        
        $orderList = Order::with('items')->where('user_id',Auth::id())->orderBy('id','desc')->paginate(); 
        return $orderList->items();
    }

    public function show($orderId)
    {
        $order = Order::with('items')->where('user_id',Auth::id())->where('id',$orderId)->first(); 
        if(!$order) {
            return ['status'=>true,'message'=>"Product doesn't exist or you don't have permission to view"]; 
        }

        return $order; 
    }


    public function confirmPlaceOrderAfterPayment($new_payment_object)
    {

        // LABEL - 1 -- Create Order Object 
        $order = new Order; 
        $order->user_id  = $new_payment_object->user_id; 
        $order->payment_id = $new_payment_object->payment_gateway_id;
        $order->payment_provider_id = $new_payment_object->payment_provider_id; 
        $order->total_amount = $new_payment_object->total_amount;
        $order->item_count = $new_payment_object->item_count;
        $order->currency = $new_payment_object->currency;
        $order->status = 'ORDERED';

        /*
            Address part 
            $table->enum('salution', ['MALE', 'FEMALE', 'OTHER', 'HIDE'])->default('MALE');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->unsignedInteger('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
        */ 

        $order->save(); 
        // $order = Order::first();

        // LABEL - 2 -- Create Order Products Object 
        $for_products = $new_payment_object->paymentProducts;
        foreach($for_products as $obj)
        {
            $order_product = new OrderProducts; 
            $order_product->order_id = $order->id; 

            $order_product->product_id =  $obj->product_id ;
            $order_product->effective_amount = $obj->effective_amount; 
            $order_product->actual_amount = $obj->actual_amount ;
            $order_product->quantity = $obj->quantity ;
            $order_product->fabric_id = $obj->fabric_id ;
            $order_product->order_type = $obj->order_type ; 
            $order_product->size = $obj->size; 
            $order_product->save();             

                
            // UPDATING PRODUCT  TABLE STATUS 
            $product = Products::find($order_product->product_id); 
            $product->user_id = $order->user_id; 
            $product->delisted_from = Carbon::now();
            $product->status = 'DELISTED'; 

            if($order_product->order_type == "PRODUCTION") 
            {
                $product->sold_on = Carbon::now(); 
                $product->status = 'SOLD';
            }

            $product->save(); 
        }

        Cart::where('user_id',$order->user_id)->delete();
        
    }
    


}
