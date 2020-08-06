@extends('layouts.app')

@section('content')
<section class="myaccount_section">
        <div class="container">
            <div class="row">
                <!-- <h2>My Account</h2> -->
                 
                         <!-- <h2> </h2> -->

                        <!-- Start Sample Orders -->
                        <div class="">
                            <h2> User Cart </h2>

                            @if( count($cartList) == 0 )

                                <div class="overview_first" style="padding: 50px;margin-bottom: 50px;">
                                    No items in Cart
                                </div>

                            @endif 

                            @foreach($cartList as $cart)
                            <div class="overview_first">
                                <h2><b>ORDER NO:</b> {{ $loop->count }} 
                                        <!-- <span> -->
                                            <!-- <a href="{{ url('order/sample/'.$cart->id) }}"> ORDER DETAILS </a> -->
                                        <!-- <i class="fa fa-angle-right"></i> </span> -->
                                </h2>
                                <div class="overview_img" onclick="return redirectToProduct('{{ $cart->product->slug }}')">
                                    <!-- <img src="" class="img-responsive"/> -->
                                    <img src="{{  url( is_numeric($cart->product->primary_image) ? ($cart->product->image_primary ? $cart->product->image_primary->location : '#') : 'img/product-images/'.$cart->product->primary_image ) }}" class="img-responsive"/>
                                </div>
                                <div class="overview_content">
                                    <h3>{{ $cart->product->title }} <span>({{ $cart->product->product_key }})</span></h3>
                                    <p>
                                        {{ $cart->product->tagline }}
                                    </p>
                                    <!-- <p>
                                        Colour: Green melange 
                                        <span>
                                            Size:  {{ $cart->size }}</span> 
                                        <span>Price: {{ $cart->amount }}</span>
                                    </p> -->
                                </div>
                                <div class="overview_button mobile_edit1">
                                    <button onclick="return removeCart({{ $cart->id }})"> <i class="fa fa-remove"></i> Remove From  Cart</button>
                                </div>
                                <!-- <div class="overview_bottom">
                                    <p><span><b>Please Note:</b>
                                       User Cart  delivered successfully. For you, we have reserved this product for 10 days. convert the sample order into a permanent order.
                                    </span></p>
                                </div> -->
                            </div>
                            @endforeach

                        <!-- End Sample Orders -->

                        </div>

                        {{ $cartList->render() }}
                
                </div>

    </section>




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

        function removeCart(cartId)
        {
            $.ajax({
                method: 'POST',
                url: '{{ url('ajax/cart/') }}/'+ cartId +'/delete',
                data: { cartId: cartId, _token: '{{ csrf_token() }}' },
                success: function(data) {
                    console.log(data);
                    // location.reload();
                }
            });

        }

        function redirectToProduct(str) {
            window.location.href = "/p/"+str; //+"/"+id;
        }
    </script>



@endsection

