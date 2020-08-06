@extends('layouts.app')

@section('content')
<section class="myaccount_section">
        <div class="container">
            <div class="row">
                <h2>My Account</h2>
                <div class="myaccount_main">
                    
                    @include('includes.account-leftside-bar')

                    <div class="myaccount_right tab-content">
                        <h2>Welcome {{ Auth::user()->name  ?? 'USER'}},</h2>
                        <p>To your private corner of The Pallete store. You can manage your orders, returns, account info and convert sample order into order right here.</p>


                        <!-- Start Sample Orders -->
                        <div class="overview tab-pane in active" id="myaccount1">
                            <h2>Your {{ $type }} order updates</h2>

                            @foreach($order_list as $order)
                                @foreach($order->items as $item)
                                    <div class="overview_first">
                                        <h2><b>ORDER NO:</b> {{ $order->id }} <span>
                                                    <!-- <a href="{{ url('order/sample/'.$order->id) }}"> ORDER DETAILS </a> -->
                                                <i class="fa fa-angle-right"></i></span>
                                        </h2>
                                        <?php
                                            if ( $item->product->primary_image && !is_numeric($item->product->primary_image) )
                                                $image = $item->product->primary_image ? 'img/product-images/'.$item->product->primary_image : '#';  
                                            else
                                                $image = $item->product->image_primary ? $item->product->image_primary->location : '#';
                                        ?>

                                        <div class="overview_img"><img src="{{ url($image) }}" class="img-responsive"/></div>
                                        <div class="overview_content">
                                            <h3>  {{ $item->product->title }} <span>(  {{ $item->product->product_key  }}  )</span></h3>
                                            <p>{{ $item->product->tagline }}</p>
                                            <p>
                                                Quantity: {{ $item->quantity }}
                                                <!-- Colour: Green melange  -->
                                                <!-- <span>Size:  {{ 'size' }}</span>  -->
                                                <span>Price: {{ $item->effective_amount }} {{ $order->currency }} </span></p> 
                                        </div>
                                        
                                        <div class="overview_button mobile_edit1">
                                            <button> {{ strtoupper($item->order_type) }} ORDER </button>
                                        </div>
                                        <!-- <div class="overview_bottom"> -->
                                            <!-- <p><span><b>Please Note:</b> -->
                                            <!-- Your sample order has been delivered successfully. For you, we have reserved this product for 10 days. convert the sample order into a permanent order. -->
                                            <!-- </span></p> -->
                                        <!-- </div> -->
                                    </div>
                                @endforeach 
                            @endforeach

                           
                        </div>
                        <!-- End Sample Orders -->

                    </div>
                </div>
                <div class="subscribe_banner">
                    <!-- <a href="javascript:void(0);"><img src="img/subscribe_banner.jpg" class="img-responsive"/></a> -->
                </div>
            </div>
        </div>

     {{ csrf_field() }}
    </section>



<div class="filter1">
    <p>Filter</p>
</div>

<div class="mobile_filter">
    <div class="mobile_show_filter">
        <h3>Filter By</h3>
        <div class="accordion">
            <h4 class="accordion-toggle">Short By</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Material</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Price</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Colour</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile_filter_close">
        <a href="javascript:void(0);">CLOSE</a>
    </div>
</div>

@endsection

@section('pageLevelJS')
  

@endsection

