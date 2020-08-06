
@extends('layouts.app')


@section('content')

<section class="address_section">
    <div class="container">
        <div class="row">
            <div class="address_main">
                <ul>
                    <li><span>1</span><b>Login</b></li>
                    <li><span>2</span><b>Address</b></li>
                    <li class="right_icon"><span>3</span><b>Confirm</b></li>
                    <li><span>4</span><b>Payment </b></li>
                    <li><span>5</span><b>Done!</b></li>
                </ul>

                <div class="delivery_address confirm">
                    <div class="delivery_address_left order_summary">
                        <h2>Order summary <span>PLACE YOUR ORDER</span></h2>
                        <div class="delivery1">
                            <h2>Delivery Estimation  </h2>
                            <p><span>{{ \Carbon\Carbon::now()->format('D, d.m') }}. – {{ \Carbon\Carbon::now()->addDay(4)->format('D d.m') }} <span>Express delivery</span></span> <span>Calculate</span></p>
                        </div>
                        <div class="delivery1">
                            <h2>Order</h2>
                            <p>
                                <span>Shipment by Pallete Store
                                    <span>{{ \Carbon\Carbon::now()->format('D, d.m') }}. – {{ \Carbon\Carbon::now()->addDay(4)->format('D d.m') }}</span>
                                </span></p>
                            <div class="cart_first">
                                <div class="cart_img"><img src="{{ $product->primary_image }}" class="img-responsive"></div>
                                <div class="cart_content">
                                    <h3> {{ $product->title }} <span>({{ $product->product_key }})</span> <b>&times;</b></h3>
                                    <p> {{ $product->tagline }}</p>
                                    <p>
                                        {{--Colour: Green melange --}}
                                        <span>Size: {{ $size }}</span><span>Price: INR {{ $amount }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="delivery_address_right">
                        <div class="delivery1">
                            <h2>Delivery address <i class="fa fa-edit"></i></h2>
                            <p>{{ $address->name }} <span> {{ $address->address }}, {{ $address->city }}</span>
                                <span>{{ $address->country }},  {{ $address->zipcode }}  </span></p>
                            {{--<h2>Billing Address <i class="fa fa-edit"></i></h2>--}}
                            {{--<p>Rakesh Mallick <span>Sovereign House, Hurworth Moor, Darlington</span> <span>United Kingdom, DL2 1QH</span></p>--}}
                        </div>
                        <div class="delivery1 gift_card">
                            <h2>Voucher/Gift Card</h2>
                            <input type="text" placeholder="Enter your code" name="">
                        </div>
                        <div class="delivery1 delivery_total">
                            <h2>Delivery <span>Free</span></h2>
                            <h3>Total <b>(VAT Included)</b> <span>INR {{ $amount }} </span></h3>
                            <form method="post" action="?tid={{$time}}">
                                {{ csrf_field() }}
                                <button>PLACE YOUR ORDER</button>
                            </form>
                        </div>
                        <p>By placing an order at Zalando.co.uk, you’re agreeing to our Privacy Policy, Terms and Conditions and Cancellation policy. We may occasionally email you product recommendations. Don’t worry, you can unsubscribe at any time by simply clicking the link in our email.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection