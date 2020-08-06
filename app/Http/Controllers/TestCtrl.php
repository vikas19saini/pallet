<?php

namespace App\Http\Controllers;

use App\Models\SampleOrders;

class TestCtrl {

    public function test_mail()
    {
        $order = SampleOrders::first(); 
        if(!$order || !$order->product)
            dd("Issue :  not found "); 
        
        // dd($order->address);  // location 
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

        return view('emails.product-order')->with($data);
    }

}