@extends('layouts.app')


@section('content')

<section class="myaccount_section trems_section">
    <div class="container">
        <div class="row">
            <div class="myaccount_main">
                <div class="myaccount_left">
                    <ul>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
                        <li class="active"><a href="/shipping-and-returns">Shipping & Returns</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                        <li><a href="/faqs">FAQ's</a></li>
                    </ul>
                    <div class="select_mobile_section">
                        <select class="mob_select" onchange="window.location.href = this.value">
                            <option value="{{ url('/about-us') }}">About Us</option>
                            <option value="{{ url('/terms-and-conditions') }}">Terms & Conditions</option>
                            <option value="{{ url('/privacy-policy') }}">Privacy Policy </option>
                            <option value="{{ url('/shipping-and-returns') }}">Shipping & Returns</option>
                            <option value="{{ url('/cookie-policy') }}">Cookie Policy</option>
                            <option value="{{ url('/faqs') }}">FAQ's</option>
                        </select>
                    </div>
                </div>
                <div class="myaccount_right tab-content">
                    <div class="overview policy_tab tab-pane fade in active">
                        <h2>Shipping & Return</h2>
                        <p>We strive to deliver products purchased in excellent condition and in the fastest time possible. Samples can be shipped in most parts of the world within 10 days. 

                            For other products our production time is based on the quantity you order. Once you share your requirement, our team will get back to you within 24 hours with lead times for production. 


                            Shipping Charges

                            Shipping charges will vary depending on your location and the quantity you order.

                            Order Tracking

                            Pallet store provides you with order reference number to track your shipment. 


                            Refund

                            Refund is only initiated for products that are not delivered.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection 
