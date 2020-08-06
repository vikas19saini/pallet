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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Event;
use App\Events\EventSendMail;

use App\Http\Controllers\Payments\PaypalCtrl; 

class OrderCtrl extends Controller
{

    public function placeOrder(Request $request)
    {

        $fields = Session::get('product');

        $fields =  [ 
            'product_id' => 67,
            'address_id' => 2,
            'size' => 1,
            'quantity' => 1,
            'amount' => 1,
            'customization' => "af",
            'time' => time()
        ];

        $data['product'] = Products::find($fields['product_id']);
        $data['address'] = Addresses::find($fields['address_id']);
        $data['size'] = $fields['size'];
        $data['quantity'] = $fields['quantity'];
        $data['amount'] = $fields['amount'];
        $data['time'] = $fields['time'];
        $data['customization'] = $fields['customization']; 

        return view('pages.place-order')->with($data);
    }

    public function confirmPlaceOrder(Request $request)
    {
        $product = Products::first();
        if( env('LOCAL_COPY') == true ) {
            $fields = [];
            $fields['address_id'] = 1;
            $fields['payment_provider_id'] = 1;
            $fields['product_id'] = $product->id;
            $fields['amount'] = $product->amount;
            $fields['quantity'] = 1;
            $fields['size'] = "lxb";
        }
        else {
            $fields = Session::get('product');
        }

        $product = Products::find($fields['product_id']);

        if(!$product)  {
            dd("Product not found"); 
        }

        $fields = PaypalCtrl::prepareFieldsForPayment($product,$fields);

        // need to create object because of paypal conf in constructor 
        $paypalCtrl = new PaypalCtrl; 
        return $paypalCtrl->payWithpaypal($request,$fields);

        // $order->amount = $fields['amount'];
        // $order->quantity = $fields['quantity'];
        // $order->size = $fields['size'];
        // $order->status = 'ORDERED';
        // $order->payment_id = 'PAY-'.time(); 
    }

    public function confirmPlaceOrderAfterPayment(Request $request)
    {
        $fields = Session::get('product');

        // TODO add check if session is empty, someone just hit enters then fail safe case
        if(!is_array($fields) || empty($fields['product_id']) ) {
            return redirect()->back();
        }

        $product = Products::find($fields['product_id']);

        if ( $fields['type'] == "sample" )
        {
            $order = new SampleOrders();
            $product->status = 'TRIAL';
            $order->customization = $fields['customization']; 
            // customization
        }
        else
        {
            $order = new ProductionOrders();
            $product->status = 'SOLD';
            $product->sold_on = Carbon::now();
        }


        $order->user_id = $request->user()->id;
        $order->product_id = $fields['product_id'];
        $order->address_id = $fields['address_id'];

    
        $address = Addresses::find($fields['address_id']); 
        $order->salution = $address->salution; 
        $order->name = $address->name; 
        $order->address = $address->address ?? " "; 
        $order->city = $address->city; 
        $order->zipcode = $address->zipcode;
        $order->country = $address->country; 
        $order->state = $address->state;

        $order->amount = $fields['amount'];
        $order->quantity = $fields['quantity'];
        $order->size = $fields['size'];
        $order->status = 'ORDERED';
        $order->payment_id = 'PAY-'.time();
        $order->save();


        $product->user_id = $request->user()->id;
        $product->delisted_from = Carbon::now();
        $product->save();

        $data['orderList'] = [
            [
                'title'=>$order->product->title,
                'description'=>$order->product->description,
                'image' => $order->product->image_primary ? $order->product->image_primary->location : 'defualt-url',
                'quantity' => $order->quantity,
                'amount' => $order->amount ,
                'product_id' => $order->product_id,
                'order' => $order
            ]
        ]; 

        $data['order'] = $order; 
        $data['total_amount']  = $order->amount; 
        $data['total_quantity'] = $order->quantity; 
        self::sendOrderCompleteMail($request->user(),$data);
        /*
         * TODO once order is done change the status of product to remove from listing
         * Parallely change the status to be shown in cart and others
         */



        return redirect('my-account');
    }

    public static function sendOrderCompleteMail($user,$data)
    {
        Event::fire( new EventSendMail($user,$data,'order.completed') );
    }


    public function address(Request $request)
    {
        $addressList = Addresses::where('user_id',Auth::id())->get();
        $timestamp = $request->get('tid');

        $orderDetails = Session::get('product');
        if($orderDetails['time'] != $timestamp)
            return redirect()->back();

        $data['countries'] = Countries::all(); 
        
        return view('pages.address')->with('addressList', $addressList)->with($data);

    }

    public function saveAddress(Request $request)
    {

        if($request->post('type') == "proceed") {
            $fields = Session::get('product');
//            [ ['production_quantity', 'quantity' , 'amount' , 'size' , 'time']
            $fields['address_id'] = $request->post('address');

            Session::put('product',$fields);
            return redirect('confirm?tid='.$fields['time']);
        }


        $address = new Addresses();
        $address->user_id = $request->user()->id;
        $address->name = $request->post('name');
        $address->address = $request->post('address');
        $address->city = $request->post('city');
        $address->zipcode = $request->post('zipcode');
        $address->country = $request->post('country');
        $address->state = $request->post('state');

        $address->save();

        return redirect()->back()->with('message',"Address saved successfully");
    }


    public function addViewAddress(Request $request)
    {
        return view('pages.user-address-edit');
    }

    public function saveMyAddress(Request $request)
    {
        $address = new Addresses();
        $address->user_id = $request->user()->id;
        $address->name = $request->post('name');
        $address->address = $request->post('address');
        $address->city = $request->post('city');
        $address->zipcode = $request->post('zipcode');
        $address->country = $request->post('country');
        $address->state = $request->post('state');
        $address->contact_no = $request->post('contact_no'); 

        $address->save();

        return redirect('my-account');
    }

    public function removeAddress(Request $request)
    {
        $address = $request->post('address');

        $address = Addresses::where('user_id',Auth::id())->where('id',$address)->first();
        $address->delete();

        return ['status'=>true,'message'=>"Address deleted successfully"];


    }

    public function viewOrder(Request $request,$type,$orderId)
    {
        if($type == "sample") {
            $data['order'] = SampleOrders::find($orderId);
        }
        else {
            $data['order'] = ProductionOrders::find($orderId);
        }

        $data['time'] = 'M';
        $data['size'] = 'M';
        $data['address'] = Addresses::find($data['order']->address_id);
        $data['amount'] = 'M';
        $data['type'] = $type;
        $data['product'] = Products::find($data['order']->product_id);

        return view('pages.view-order')->with($data);
    }

}
