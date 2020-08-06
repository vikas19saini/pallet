
@extends('layouts.app')


@section('content')

<section class="address_section">
    <div class="container">
        <div class="row">
            <div class="address_main">
                <ul>
                    <li><span>1</span><b>Cart</b></li>
                    <li><span>2</span><b>Address</b></li>
                    <li class="right_icon"><span>3</span><b>Confirm</b></li>
                    <li><span>4</span><b>Payment </b></li>
                    <li><span>5</span><b>Done!</b></li>
                </ul>

                <div class="delivery_address confirm">
                    <div class="delivery_address_left order_summary">
                        <h2>Order summary</h2>
                        <div class="delivery1">
                            <h2>Delivery Estimation  </h2>
                            <p>{{ $shipping['DeliveryDate'] }} | <span> {{ $shipping['ServiceType'] }}</span></p>
                        </div>

                        <?php $total_price = 0; ?>

                        <div class="delivery1">
                            <h2>Order</h2>
                            @foreach($cartItems as $item)
                            <?php
                            $product = $item->product;
                            $total_price += $item->amount;
                            ?>
                            <div class="cart_first">
                                <div class="cart_img">
                                    <img src="{{ url( is_numeric($product->primary_image) ? ($product->image_primary ? $product->image_primary->location : '#') : 'img/product-images/'.$product->primary_image )  }}" class="img-responsive"></div>
                                <div class="cart_content">
                                    <h3> {{ $product->title }} <span>({{ $product->product_key }})</span></h3>
                                    <p> {{ $product->tagline }}</p>
                                    <p>Quantity: {{ $item->quantity }} pcs</p>
                                    <p id="cart-item-price-{{ $item->id }}" val="{{ $item->amount }}">Price: ${{ $item->amount }}</p>
                                    <p>Type: {{ $item->order_type }}</p>
                                </div>
                            </div>
                            @endforeach
                            <?php $total_price += $shipping['DeliveryCharges'];?>
                        </div>

                    </div>
                    <?php $address = $cartItems[0]->address ?>

                    <div class="delivery_address_right">
                        <div class="delivery1">
                            <h2>Delivery address</h2>
                            <p>{{ $address->name }} <span> {{ $address->address }}, {{ $address->city }}</span>
                                <span>{{ $address->country }},  {{ $address->zipcode }}  </span></p>
                        </div>
                        <div class="delivery1 delivery_total">
                            <h3>Sub total <span>${{ number_format($total_price - $shipping['DeliveryCharges'], 2) }}</span></h3>
                            <h3>Delivery <span id="delivery_charges">${{ $shipping['DeliveryCharges'] }}</span></h3>
                            <h3>Total <b>(VAT Included)</b> <span>${{ $total_price }} </span></h3>
                            <button type="button" onclick="return verifyCart()">PLACE YOUR ORDER</button>
                            <span id="cart-empty-err-msg" style="color: red;display:none"> No Item In cart </span>
                        </div>
                        <p>By placing an order at thepalettestore.in, you’re agreeing to our Privacy Policy, Terms and Conditions and Cancellation policy. We may occasionally email you product recommendations. Don’t worry, you can unsubscribe at any time by simply clicking the link in our email.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    function verifyCart() {

        if (changeCheckoutButtonStatus() === false)
        {
            return false;
        }

        window.location.href = "{{ url('/') }}/checkout";
        return false;
    }

    function changeCheckoutButtonStatus()
    {
        if ($('[id^="cart-item-price-"]').length == 0)
        {
            $("#cart-empty-err-msg").show();
            return false;
        }

        return true;
    }
</script>

@endsection