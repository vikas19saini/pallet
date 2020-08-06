@extends('layouts.app')

@section('content')

<section class="cart_section">
  <div class="container">
    <div class="row">
      <div class="cart_area">
        <div class="cart_left">
            <div class="cart_first">
                <h2 style="margin-bottom: 0px">My Bag (  <count id="cart-total-item-count"> {{ count($cartItems)}} </count>  item)  </h2>
            </div>

            @foreach($cartItems as $item)
                <div class="cart_first" id="cart-item-block-{{ $item->id }}">
                    <div class="cart_img">
                        <img src="{{ url('img/product-images/' . $item->product->primary_image) }}" class="img-responsive">
                    </div>
                    <div class="cart_content">
                    <h3> 
                        {{ $item->product->title }} <span>({{ $item->product->product_key }})</span> 
                        <b>
                            {{ $item->order_type == "SAMPLE" ? "3 Pieces" : $item->quantity." Pieces"}}
                        </b>
                    </h3>
                    <p>
                        {{ $item->product->tagline }} | <strong>{{ $item->order_type}}</strong>
                    </p>
                    <p>Fabric: {{ $item->fabrics->name }}</p>
                    <span style="cursor: pointer" onclick="removeItemFrommCart({{ $item->id }})">
                        <i class="fa fa-trash"> </i> Remove &nbsp; 
                    </span>
                    <span>
                        <b id="cart-item-price-{{ $item->id }}" val="{{ $item->amount }}">
                            $ {{ $item->changeCurrencyFormat($item->amount, '$') }}
                        </b>   
                    </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="cart_right">
           <div class="cart_total">
              <h2>Total</h2>
              <p>Subtotal <span id="cart-subtotal-price"></span> </p>
              <p class="total_price">
                Total (Tax Included) <span id="cart-total-price"></span> </p>
                <button>
                    <a href="/cart/address">GO TO CHECKOUT</a>
<!--                    <a href="/cart/address" onclick="return verifyCart()">GO TO CHECKOUT</a>-->
                </button>
                <span id="cart-empty-err-msg" style="color: red;display:none"> No Item In cart </span>
           </div>
        </div>
      </div>
    </div>
  </div>  
</section>





@endsection

@section('pageLevelJS')       

    <script>

    function calculatePrice(){
        var price = 0;
        var cart_item_length = 0; 
        $('[id^="cart-item-price-"]').each( function(index,item) { 
            price += parseFloat( $(item).attr('val') ); 
            ++cart_item_length; 
        });

        $("#cart-total-item-count").html( cart_item_length );
        $("#cart-total-price").html("$" + price);
        $("#cart-subtotal-price").html("$" + price);

    }

    function countryFormatter() {
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: '$',
            minimumFractionDigits: 2
        }); 

        formatter.format(1000) // "$1,000.00"
        formatter.format(10) // "$10.00"
        formatter.format(123233000) // "$123,233,000.00" 

    }

    $(document).ready(function(){
        calculatePrice();

    }); 


    function removeItemFrommCart(cartId) {
        $.ajax({
                method: 'POST',
                url: '{{ url('ajax/cart/') }}/'+ cartId +'/delete',
                data: { cartId: cartId, _token: '{{ csrf_token() }}' },
                success: function(data) {
                    $("#cart-item-block-"+cartId).remove(); 
                    calculatePrice(); 
                    // location.reload();
                }
        }); 
    }

    function changeCheckoutButtonStatus()
    {
        if( $('[id^="cart-item-price-"]').length == 0 ) 
        {
            $("#cart-empty-err-msg").show(); 
            return false;
        }

        return true; 
    }

    </script>

@endsection

