@extends('layouts.app')

@section('content')
<section class="myaccount_section">
        <div class="container">
            <div class="row">
                <h2>My Account</h2>
                <div class="myaccount_main">
                    <div class="myaccount_left">
                        <ul>
                            <li class="active"><a data-toggle="tab" href="#myaccount1">My Overview</a></li>
                            <li><a data-toggle="tab" href="#myaccount2">Sample Orders</a></li>
                            <li><a data-toggle="tab" href="#myaccount3">Production Orders</a></li>
                            <li><a data-toggle="tab" href="#myaccount4">Returns/Cancelled</a></li>
                            <li><a data-toggle="tab" href="#myaccount5">My Contact Data</a></li>
                            <li><a data-toggle="tab" href="#myaccount6">My Address Book</a></li>
                            <li class="click_tab"><a data-toggle="tab" href="#myaccount7">My Preferences</a></li>
                            <li class="click_tab"><a data-toggle="tab" href="#myaccount8">My Coupons</a></li>
                            <li><a data-toggle="tab" href="#myaccount9">Help & FAQs</a></li>
                            <li>
                                <form action="post">
                                    {{ csrf_field() }} 
                                    <input style="border: none;background: none;" type="submit" value="Logout" />
                                </form>
                            </li>
                        </ul>
                        <div class="select_mobile_section">
                            <select class="mob_select" id="show" onchange="change()">
                                <option value="0">My Overview</option>
                                <option value="1">Sample Orders </option>
                                <option value="2">Production Orders</option>
                                <option value="3">Returns/Cancelled</option>
                                <option value="4">My Contact Data</option>
                                <option value="5">My Address Book</option>
                                <option value="6">My Preferences</option>
                                <option value="7">My Coupons</option>
                                <option value="8">Help & FAQs</option>
                            </select>
                        </div>
                    </div>
                    <div class="myaccount_right tab-content">
                        <h2>Welcome {{ Auth::user()->name  ?? 'USER'}},</h2>
                        <p>To your private corner of The Pallete store. You can manage your orders, returns, account info and convert sample order into order right here.</p>


                        <!-- Start Overview  -->
                        <div class="overview tab-pane fade in active" id="myaccount1">
                            <h2>Your latest order updates</h2>


                            @foreach($overview as $order)
                                <div class="overview_first">
                                    <h2><b>ORDER NO:</b> {{ $order->id }} - {{ $order->type }} <span>
                                            <a href="{{ url('order/'.$order->type.'/'.$order->id) }}"> ORDER DETAILS </a>
                                            <i class="fa fa-angle-right"></i></span></h2>
                                    <div class="overview_img"><img src="{{ url($order->product->primary_image) }}" class="img-responsive"/></div>
                                    <div class="overview_content">
                                        <h3>{{ $order->product->title }} <span>({{ $order->product->product_key }})</span></h3>
                                        <p>{{ $order->product->tagline }}</p>
                                        <p>Colour: Green melange <span>Size:  {{ $order->size }}</span> <span>Price: {{ $order->amount }}</span></p>
                                    </div>
                                    <div class="overview_button mobile_edit1">
                                        <button>PERMANENT ORDER</button>
                                    </div>
                                    <div class="overview_bottom">
                                        <p><span><b>Please Note:</b>
                                    Your sample order has been delivered successfully. For you, we have reserved this product for 10 days. convert the sample order into a permanent order.
                                    </span></p>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <!-- End Overview -->

                        <!-- Start Sample Orders -->
                        <div class="overview tab-pane fade" id="myaccount2">
                            <h2>Your Sample order updates</h2>

                            @foreach($sampleOrders as $order)
                            <div class="overview_first">
                                <h2><b>ORDER NO:</b> {{ $order->id }} <span>
                                            <a href="{{ url('order/sample/'.$order->id) }}"> ORDER DETAILS </a>
                                        <i class="fa fa-angle-right"></i></span>
                                </h2>
                                <div class="overview_img"><img src="{{ url($order->product->primary_image) }}" class="img-responsive"/></div>
                                <div class="overview_content">
                                    <h3>{{ $order->product->title }} <span>({{ $order->product->product_key }})</span></h3>
                                    <p>{{ $order->product->tagline }}</p>
                                    <p>Colour: Green melange <span>Size:  {{ $order->size }}</span> <span>Price: {{ $order->amount }}</span></p>
                                </div>
                                <div class="overview_button mobile_edit1">
                                    <button>PERMANENT ORDER</button>
                                </div>
                                <div class="overview_bottom">
                                    <p><span><b>Please Note:</b>
                                    Your sample order has been delivered successfully. For you, we have reserved this product for 10 days. convert the sample order into a permanent order.
                                    </span></p>
                                </div>
                            </div>
                            @endforeach

                            {{--<div class="overview_first">--}}
                                {{--<h2><b>ORDER NO:</b> 1099625-8650311-9265001 <span>ORDER DETAILS <i class="fa fa-angle-right"></i></span></h2>--}}
                                {{--<div class="overview_img"><img src="img/myaccount.jpg" class="img-responsive"/></div>--}}
                                {{--<div class="overview_content">--}}
                                    {{--<h3>Crewneck Sweater <span>(SKU 191M2P38100)</span></h3>--}}
                                    {{--<p>Cotton crew-neck sweater with bouclé stripes</p>--}}
                                    {{--<p>Colour: Green melange <span>Size: M</span> <span>Price: A$ 2,120</span></p>--}}
                                {{--</div>--}}
                                {{--<div class="overview_button ">--}}
                                    {{--<button>CANCEL ORDER</button> <button class="mobile_btn">TRACK ORDER</button>--}}
                                {{--</div>--}}
                                {{--<div class="overview_bottom">--}}
                                    {{--<p><span><b>Please Note:</b> Your order has been processed successfully. Please track your order here</span><span>TRACK ORDER</span></p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="overview_first">--}}
                                {{--<h2><b>ORDER NO:</b> 1099625-8650311-9265001 <span>ORDER DETAILS <i class="fa fa-angle-right"></i></span></h2>--}}
                                {{--<div class="overview_img"><img src="img/myaccount.jpg" class="img-responsive"/></div>--}}
                                {{--<div class="overview_content">--}}
                                    {{--<h3>Crewneck Sweater <span>(SKU 191M2P38100)</span></h3>--}}
                                    {{--<p>Cotton crew-neck sweater with bouclé stripes</p>--}}
                                    {{--<p>Colour: Green melange <span>Size: M</span> <span>Price: A$ 2,120</span></p>--}}
                                {{--</div>--}}
                                {{--<div class="overview_button mobile_btn">--}}
                                    {{--<button class="mobile_btn">TRACK ORDER</button>--}}
                                {{--</div>--}}
                                {{--<div class="overview_bottom">--}}
                                    {{--<p><span><b>Please Note:</b> Your order has been Dispached. Please track your order here</span><span>TRACK ORDER</span></p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="overview_first">--}}
                                {{--<h2><b>ORDER NO:</b> 1099625-8650311-9265001 <span>ORDER DETAILS <i class="fa fa-angle-right"></i></span></h2>--}}
                                {{--<div class="overview_img"><img src="img/myaccount.jpg" class="img-responsive"/></div>--}}
                                {{--<div class="overview_content">--}}
                                    {{--<h3>Crewneck Sweater <span>(SKU 191M2P38100)</span></h3>--}}
                                    {{--<p>Cotton crew-neck sweater with bouclé stripes</p>--}}
                                    {{--<p>Colour: Green melange <span>Size: M</span> <span>Price: A$ 2,120</span></p>--}}
                                {{--</div>--}}
                                {{--<div class="overview_button">--}}
                                    {{--<p><b>Order Cancelled</b> (Wed. 20. 2. 19)</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <!-- End Sample Orders -->

                        <!-- Start Production  Orders -->
                        <div class="overview tab-pane fade" id="myaccount3">
                            <h2>Your Production order updates</h2>

                            @foreach($productionOrders as $order)
                                <div class="overview_first">
                                    <h2>
                                        <b>ORDER NO:</b> {{ $order->id }}
                                        <span>
                                            <a href="{{ url('order/production/'.$order->id) }}"> ORDER DETAILS </a>
                                            <i class="fa fa-angle-right"></i></span>
                                    </h2>
                                    <div class="overview_img"><img src="{{ url($order->product->primary_image) }}" class="img-responsive"/></div>
                                    <div class="overview_content">
                                        <h3>{{ $order->product->title }} <span>({{ $order->product->product_key }})</span></h3>
                                        <p>{{ $order->product->tagline }}</p>
                                        <p>Colour: Green melange <span>Size:  {{ $order->size }}</span> <span>Price: {{ $order->amount }}</span></p>
                                    </div>
                                    <div class="overview_button">
                                        <button>PERMANENT ORDER</button>
                                        {{--<button>RE-ORDER</button>--}}
                                        {{--<button>CANCEL ORDER</button>--}}
                                        <button class="mobile_btn">TRACK ORDER</button>
                                    </div>
                                    <div class="overview_bottom overview_delivered">
                                        <p>
                                            <span>
                                                <b>Please Note:</b>
                                                @if($order->status == "DELIVERED")
                                                    Please Note: Your sample order has been delivered successfully. If you want to order again, Please click on Re-order Button and follow the process.
                                                @elseif($order->status == "PROCESSING")
                                                    Please Note: Your order has been processed successfully. Please track your order here
                                                @elseif($order->status == "dipatced")
                                                    Please Note: Your order has been Dispached. Please track your order here
                                                @else
                                                     glhjk kjhkjh kh
                                                @endif
                                            </span>

                                           <i>
                                               <b>Order Cancelled</b> (Wed. 20. 2. 19)
                                            </i>
                                        </p>

                                    </div>
                                    {{--<div class="overview_button">--}}
                                    {{--<p><b>Order Cancelled</b> (Wed. 20. 2. 19)</p>--}}
                                    {{--</div>--}}
                                </div>
                            @endforeach

                            {{--<div class="overview_first">--}}
                                {{--<h2><b>ORDER NO:</b> 1099625-8650311-9265001 <span>ORDER DETAILS <i class="fa fa-angle-right"></i></span></h2>--}}
                                {{--<div class="overview_img"><img src="img/myaccount.jpg" class="img-responsive"/></div>--}}
                                {{--<div class="overview_content">--}}
                                    {{--<h3>Crewneck Sweater <span>(SKU 191M2P38100)</span></h3>--}}
                                    {{--<p>Cotton crew-neck sweater with bouclé stripes</p>--}}
                                    {{--<p>Colour: Green melange <span>Size: M</span> <span>Price: A$ 2,120</span></p>--}}
                                {{--</div>--}}
                                {{--<div class="overview_button ">--}}
                                    {{--<button>CANCEL ORDER</button> <button class="mobile_btn">TRACK ORDER</button>--}}
                                {{--</div>--}}
                                {{--<div class="overview_bottom">--}}
                                    {{--<p><span><b>Please Note:</b> Your order has been processed successfully. Please track your order here</span><span>TRACK ORDER</span></p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <!-- End Production  Orders -->

                        <!-- Start Returns/Cancelled  Orders -->
                        <div class="overview tab-pane fade" id="myaccount4">
                            <h2>Order cancel Request</h2>
                            <div class="overview_first">
                                <p><b>PLACED ON:</b>  Sun 17. 2. 2019</p>
                                <p><b>ORDER NO:</b>   1099625-8650311-9265001</p>
                                <p><b>PAYMENT MODE:</b>  Credit Card</p>
                            </div>
                            <div class="overview_first">
                                <h2><b>ORDER NO:</b> 1099625-8650311-9265001</h2>
                                <div class="overview_img"><img src="img/myaccount.jpg" class="img-responsive"/></div>
                                <div class="overview_content">
                                    <h3>Crewneck Sweater <span>(SKU 191M2P38100)</span></h3>
                                    <p>Cotton crew-neck sweater with bouclé stripes</p>
                                    <p>Colour: Green melange <span>Size: M</span> <span>Price: A$ 2,120</span></p>
                                </div>
                            </div>
                            <div class="cancel_order">
                                <h4>Reason for Cancel*</h4>
                                <p>Please tell us the reason for return. This information is only used to imrove our service</p>
                                <span>Select issue*</span>
                                <ul>
                                    <li>I changed my mind</li>
                                    <li>Received defective product</li>
                                    <li>My reason is not listed</li>
                                    <li>Product quality is not same as sample order</li>
                                </ul>
                                <textarea  rows="5" placeholder="Additional comments"></textarea>
                            </div>
                            <div class="cancel_order cancel_order_check">
                                <h4>Mode of refund</h4>
                                <p class="checkbox_edit"><label for="checkbox_cancel_order">Back to source</label> <input type="checkbox" id="checkbox_cancel_order"><span class="checkmark"></span></p>
                                <p class="checkbox_edit"><label for="checkbox_cancel_order2">Other Account</label> <input type="checkbox" id="checkbox_cancel_order2"><span class="checkmark"></span></p>
                                <p class="checkbox_edit"><label for="checkbox_cancel_order3">Palette Store credits</label> <input type="checkbox" id="checkbox_cancel_order3"><span class="checkmark"></span></p>
                            </div>
                            <div class="cancel_order cancel_order_check">
                                <p class="checkbox_edit"><label for="checkbox_cancel_order4">Back to source</label> <input type="checkbox" id="checkbox_cancel_order4"><span class="checkmark"></span></p>
                            </div>
                        </div>
                        <!-- End Returns/Cancelled  Orders -->

                        <!-- Start My Contact Data  Orders -->
                        <div class="overview tab-pane fade" id="myaccount5">
                            <h2>Change contact details</h2>
                            <div class="contact_myaccount">
                                <div class="contact_first">
                                    <h2>Personal Information</h2>
                                    <form method="POST">
                                        <input type="hidden" name="type" value="contact_form">

                                        {{ csrf_field() }}

                                        <div class="form-group radio_icon">
                                            <label>Mrs. / Ms.
                                                <input type="radio" checked="checked" name="gender" value="male">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label>Mr.<input type="radio" name="gender" value="female">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Full Name*</label>
                                            <input type="text" name="name" value="{{ Auth::user()->email  ?? 'USER EMAIL'}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number*</label><input type="text" name="mobile" placeholder="Enter mobile no" value="{{ Auth::user()->mobile  ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Alternative Number</label><input type="text" name="alternate_mobile" placeholder="enter alternative mobile" value="{{ Auth::user()->alternate_mobile  ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <span>* mandatory field</span></div><div class="form-group">
                                            <button>SAVE</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End My Contact Data  Orders -->

                        <!-- Start My Address Book  Orders -->
                        <div class="overview tab-pane fade" id="myaccount6">
                            <h2>My address book
                                <span>
                                    <a href="{{ url('address/new') }}">ADD NEW ADDRESS </a>
                                </span>
                            </h2>

                            {{--<div class="address_myaccount">--}}
                                {{--<h2>Default address</h2>--}}
                                {{--<p>Rakesh Mallick <span>Sovereign House, Hurworth Moor, Darlington</span> <span>United Kingdom, DL2 1QH</span></p>--}}
                                {{--<div class="adress_btn">--}}
                                    {{--<span><button>EDIT</button></span>--}}
                                    {{--<span><button>REMOVE</button></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <h3>Other address</h3>
                            @foreach($addresses as $address)
                            <div class="address_myaccount address_myaccount2">
                                <p>
                                    {{ $address->name }}
                                    <span>{{ $address->address }}, {{$address->city}}, {{ $address->state }}</span>
                                    <span>{{ $address->country }}, {{ $address->country }}</span>
                                </p>
                                <div class="adress_btn">
                                    <p class="checkbox_edit"><label for="checkbox_id2">Make this address my default address</label> <input type="checkbox" id="checkbox_id2"><span class="checkmark"></span></p>
                                    <span>
                                        <button>EDIT</button> 
                                    </span>
                                    <span><button onclick="return remove_address({{ $address->id }})">REMOVE</button></span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- End My Address Book  Orders -->

                        <!-- Start My Preferences  Orders -->
                        <div class="overview tab-pane fade" id="myaccount7">
                            <h2>My preferences</h2>
                            <p>Welcome to your preferences section of The Pallete store. You can convert your preferences into sample order right here.</p>
                            <div class="preferences">

                                @foreach($preferences  as $preference)
                                    <div class="preferences1">
                                        <img src="{{ url( $product->image_primary ? $product->image_primary->location : '#') }}" class="img-responsive"/>
                                        <p>
                                            <span>
                                                {{ $preference->product->title }}
                                            
                                                <span>
                                                    <!-- <i>$ 30</i>    -->
                                                    INR {{ $preference->product->amount }} 
                                                </span>
                                            </span><span><b></b><b></b><b></b><b></b></span></p>
                                        <h3> {{ $preference->product->status}} </h3>
                                        <!-- <a href="javascript:void(0);">SHOW SIMILAR</a> -->
                                        <div class="close"></div>
                                    </div>
                                @endforeach 

                                @if( count( $preferences ) == 0 )
                                    No Item In Wishlist 
                                @endif 

                                <!-- <div class="preferences1">
                                    <img src="img/preferences2.jpg" class="img-responsive"/>
                                    <p><
                                            span>V-neck Kaftan <span><
                                                    i>$ 30</i>   $
                                                    INR24<
                                                    /span><
                                                        /span><span><b></b><b></b><b></b><b></b></span></p>
                                    <h3>SOLD OUT</h3>
                                    <a href="javascript:void(0);">SHOW SIMILAR</a>
                                    <div class="close"></div>
                                </div> -->

                            </div>
                        </div>
                        <!-- End My Preferences  Orders -->

                        <!-- Start My Coupons  Orders -->
                        <div class="overview tab-pane fade" id="myaccount8">
                            <h2>My coupons</h2>
                            <div class="coupons_myaccount">
                                <h3>Your pallete credit balance:  <span>A$ 1,000</span></h3>
                                <p>You can use your Pallete credit to pay - in part, or in full - for your future orders. Credit cannot be exchanged for cash.</p>
                            </div>
                            <div class="coupons_myaccount">
                                <h3>Do you want redeem a coupon/gift card</h3>
                                <p>Please enter your Gift/Coupon Card code and click redeem. The balance will be credited to your account.</p>
                                <div class="coupon_area">
                                    <input type="text" name="" placeholder="Enter your code" />
                                    <button>REDEEM</button>
                                </div>
                            </div>
                        </div>
                        <!-- End My Coupons  Orders -->


                    </div>
                </div>
                <div class="subscribe_banner">
                    <a href="javascript:void(0);"><img src="img/subscribe_banner.jpg" class="img-responsive"/></a>
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
    <script>
        $(document).ready(function(){
            $(".myaccount_left ul li").click(function(){
                $(".myaccount_right").removeClass("active");
            });
            $(".myaccount_left ul li.click_tab").click(function(){
                $(".myaccount_right").addClass("active");
            });
        });


        $("#show").change(function(){
            if($(this).val()=="1"){
                $("#myaccount2").addClass("active");
                $("#myaccount1, #myaccount3, #myaccount4, #myaccount5, #myaccount6, #myaccount7, #myaccount8, #myaccount9").removeClass("active");
                $(".myaccount_right").removeClass("active");
            }
            else if($(this).val()=="2"){;
                $("#myaccount3").addClass("active");
                $("#myaccount2, #myaccount1, #myaccount4, #myaccount5, #myaccount6, #myaccount7, #myaccount8, #myaccount9").removeClass("active");
                $(".myaccount_right").removeClass("active");
            }
            else if($(this).val()=="3"){
                $("#myaccount4").addClass("active");
                $("#myaccount2, #myaccount1, #myaccount3, #myaccount5, #myaccount6, #myaccount7, #myaccount8, #myaccount9").removeClass("active");
                $(".myaccount_right").removeClass("active");
            }
            else if($(this).val()=="4"){
                $("#myaccount5").addClass("active");
                $("#myaccount2, #myaccount3, #myaccount1, #myaccount4, #myaccount6, #myaccount7, #myaccount8, #myaccount9").removeClass("active");
                $(".myaccount_right").removeClass("active");
            }
            else if($(this).val()=="5"){
                $("#myaccount6").addClass("active");
                $("#myaccount2, #myaccount3, #myaccount4, #myaccount1, #myaccount5, #myaccount7, #myaccount8, #myaccount9").removeClass("active");
                $(".myaccount_right").removeClass("active");
            }
            else if($(this).val()=="6"){
                $("#myaccount7").addClass("active");
                $("#myaccount2, #myaccount3, #myaccount4, #myaccount5, #myaccount1, #myaccount6, #myaccount8, #myaccount9").removeClass("active");
                $(".myaccount_right").addClass("active");
            }
            else if($(this).val()=="7"){
                $("#myaccount8").addClass("active");
                $("#myaccount2, #myaccount3, #myaccount4, #myaccount5, #myaccount6, #myaccount1, #myaccount7, #myaccount9").removeClass("active");
                $(".myaccount_right").addClass("active");
            }
            else if($(this).val()=="8"){
                $("#myaccount9").addClass("active");
                $("#myaccount2, #myaccount3, #myaccount4, #myaccount5, #myaccount6, #myaccount7, #myaccount1, #myaccount8").removeClass("active");
                $(".myaccount_right").removeClass("active");
            }
            else{
                $("#myaccount1").addClass("active");
                $("#myaccount2, #myaccount3, #myaccount4, #myaccount5, #myaccount6, #myaccount7, #myaccount8, #myaccount9").removeClass("active");
                $(".myaccount_right").removeClass("active");
            }
        });

        function remove_address(addressId)
        {
            $.ajax({
                method: 'POST',
                url: '{{ url('address/remove') }}',
                data: { address: addressId, _token: '{{ csrf_token() }}' },
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            });

        }
    </script>



@endsection

