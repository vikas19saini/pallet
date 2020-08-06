@extends('layouts.app')

@section('content')


    <section class="product_details">
        <div class="container">

            @if(isset($status) && $status === false)
                <div class="row">
                    <center style="padding: 300px 100px;font-size: xx-large;">
                        {{ $message }}  
                        <br /> 
                        status code - 410 
                    </h2>
                </div>
            @else 
            <div class="row">
                <h2>Home > {{ $product->category->name  }}> {{ $product->product_key }}</h2>
                <div class="product_details_main">

                    @if($product->status == 'LISTED')
                    <div class="product_details_left">
                        <div class="product_details_small">

                        @foreach($productImages as $image)
                                <img src="{{ url($image->location) }}" class="img-responsive" alt="" data-img="{{ url($image->location) }}"/>
                            @endforeach
                            {{--<img src="{{ $product->productImages[0] ? url($product->productImages[0]->image) : '' }}" class="img-responsive active" alt="" data-img="src="{{ $product->productImages[0] ? url($product->productImages[0]->image) : '' }}""/>--}}
                            {{--<img src="{{ $product->productImages[1] ? url($product->productImages[1]->image) : '' }}" class="img-responsive" alt="" data-img="src="{{ $product->productImages[1] ? url($product->productImages[1]->image) : '' }}""/>--}}
                            {{--<img src="{{ $product->productImages[2] ? url($product->productImages[2]->image) : '' }}" class="img-responsive" alt="" data-img="src="{{ $product->productImages[2] ? url($product->productImages[2]->image) : '' }}""/>--}}
                            {{--<img src="{{ $product->productImages[3] ? url($product->productImages[3]->image) : '' }}" class="img-responsive" alt="" data-img="src="{{ $product->productImages[3] ? url($product->productImages[3]->image) : '' }}""/>--}}
                            {{--<img src="img/product_details/small5.jpg" class="img-responsive" alt="" data-img="img/product_details/small5.jpg"/>--}}
                        </div>
                        <div class="product_details_big">
                            <img src="{{  url( $product->image_primary ? $product->image_primary->location : '#') }}" class="img-responsive dynamic_img" alt=""/>
                        </div>
                    </div>
                    <div class="product_details_right">
                        <span> {{ $product->product_key }}</span>
                        <h2> {{ $product->title }} <span> {{ $product->tagline }}</span></h2>
                        <p>INR {{ $product->amount }}</p>
                        <div class="color_section">
                            <h2>Colors Available</h2>
                            <p class="color_click">
                                <!-- <span class="color1"></span>
                                <span class="color2"></span>
                                <span class="color3"></span>
                                <span class="color4"></span> -->

                                @foreach($product->productColors as $item)
                                    <span style="background-color: #{{$item->color_code}}"></span>
                                @endforeach 

                            </p>


                            <div class="col-sm-12">
                                <div class="form-group">
                                <label for="select_size">Select Fabric</label>
                                <select name="" class="select_size form-control">
                                    @foreach($product->product_has_fabrics as $item)
                                        <option value="{{$item->fabric_id}}">{{ $item->fabric->name }}</option>
                                    @endforeach 
                                </select> 
                                </div>
                            </div>

                            <h2 class="product_h2">Product Description</h2>
                            <p>
                                {{ $product->description }}
                            </p>
                            <h2  class="product_h2">Check Delivery Locations</h2>
                            <p class="location_span">Location
                                <span>
                  <input type="text" name=""/><span>CHECK</span>
                  <i class="fa fa-map-marker"></i>
                </span>
                            </p>
                        </div>
                        <div class="details_section">
                            <div class="details_btn">
                                <button class="details_btn1 active">ORDER SAMPLE</button>
                                <button class="details_btn2">BUY PRODUCTION</button>
                            </div>

                            <div id="customization_section"> 
                                <input id="customization_check" type="checkbox" name="customization_check"> 
                                <br>    
                                <textarea style="display:none" id="customization" name="customization" placeholder="Enter Customization"></textarea> 
                            </div>

                            <p>When you order sample the products get de-listed from website for 14 days. If the production order is not placed within 14 days the product gets again listed for others.</p>


                            <table class="table table-bordered" id="fabric_price_table" style="margin-top: 15px">
                                <tr>
                                    <td> Fabric </td>
                                    <td> Sample Price </td>
                                    <td> Production Price </td>
                                </tr>
                                
                                @foreach($product->product_has_fabrics as $item)
                                    <tr class="fabric-type-price" id="{{ 'fabric-type-'.$item->fabric_id }}">
                                        <td val="tag-{{ $item->fabric_id }}"> {{ $item->fabric ? $item->fabric->name : '' }} </td>
                                        <td amount="{{ $item->amount }}"> {{ $item->amount }} </td>
                                        <td amount="{{ $item->amount }}"> {{ $item->amount }} </td>
                                    </tr>
                                @endforeach 
                            
                            </table>

                            <div class="size_details">
                                <span>Add Size & Quantity</span>
                                <div class="select_size">
                                    <span>
                                        <b id="size_abbr"> M </b>
                                        <select id="size" name="size" onchange="changeSize(this)">
                                        <option value="S">Small Size</option>
                                        <option value="M">Medium Size</option>
                                        <option value="L">Large Size</option>
                                        <option value="XL">Extra Large Size</option>
                                        </select>
                                    </span>
                                    <span class="order_details active" style="width: 120px; margin-left: 50px;">
                                        <input onchange="return validateQuantity(this)" onkeyup="return validateNumber(this)" type="text" value="1" name="quantity" id="quantity" style="outline: none; border: 0px;-webkit-appearance: none;width: 45px;"/>
                                        Pcs
                                    </span>
                                    <span class="buy_production">
                                        <select name="production_quantity" id="production_quantity" onchange="return validateQuantity(this)">
                                        <option value="12">12 Pcs</option>
                                        <option value="24">24 Pcs</option>
                                        <option value="36">36 Pcs</option>
                                        <option value="48">48 Pcs</option>
                                        <option value="60">60 Pcs</option>
                                        </select>
                                    </span>
                                </div>

                                <p>Size Guide <span>Can’t find your size?</span></p>
                                <p>You can purchase the product in multiples of 12. </p>
                            </div>

                            <table class="table table-bordered" id="price_table" style="display: none">
                                <tr>
                                    <td>Quantity </td>
                                    <td>Price </td>
                                </tr>
                                <tr>
                                    <td id="price_table_quantity">  </td>
                                    <td id="price_table_amount">  </td>
                                </tr>
                            </table>

                            <div >
                                <form action="" method="post" onsubmit="return submitCart()">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="add_cart">
                                                <button style="width: 60%">ADD TO CART</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="add_cart">
                                                <button onclick="return wishlist({{ $product->id }});" id="wishlist_label_btn" style="width: 60%">ADD TO WISHLIST</button>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <span id="form_error" style="color: red;" ></span>
                                    <input type="hidden" name="amount" id="form_amount" />
                                    <input type="hidden" name="type" id="type" value="sample" />
                                    <input type="hidden" name="production_quantity" id="form_production_quantity" />
                                    <input type="hidden" name="quantity" id="form_quantity" />
                                    <input type="hidden" name="size" id="form_size" />
                                    <input type="hidden" name="form_customization" id="form_customization" />
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                        <div class="accordion">
                            <h4 class="accordion-toggle">Details</h4>
                            <div class="accordion-content">
                                <p>Cras malesuada ultrices augue molestie risus.</p>
                            </div>

                            <h4 class="accordion-toggle">Material & Care</h4>
                            <div class="accordion-content">
                                <p>Cras malesuada ultrices augue molestie risus.</p>
                            </div>

                            <h4 class="accordion-toggle">Sampling & Order</h4>
                            <div class="accordion-content">
                                <p>Cras malesuada ultrices augue molestie risus.</p>
                            </div>
                            <h4 class="accordion-toggle">Shipping & Returns</h4>
                            <div class="accordion-content">
                                <p>Cras malesuada ultrices augue molestie risus.</p>
                            </div>
                        </div>
                    </div>
                    @else
                        <h2 style="margin-left: auto;margin-right: auto"> Product is not available. </h2>
                    @endif

                </div>
            </div>
            @endif 
        </div>
    </section>

    @if(!(isset($status) && $status === false))
        @include('includes.related')
    @endif 

@endsection

@section('pageLevelJS')


    @if(!(isset($status) && $status === false))
    <script>

        var amount  = {{ $product->amount }};

        $(document).ready(function() {
            $(".product_details_small>img").click(function(){
                $(this).addClass("active");
                $(this).siblings().removeClass("active")
                var dataImg = $(this).attr("data-img");
                $(".dynamic_img").attr("src", dataImg);
                $("#quantity").val(1);
            });
            $(".details_btn1").click(function(){
                $(".order_details").addClass("active");
                $(".buy_production").removeClass("active");
                $(this).addClass("active");
                $(".details_btn2").removeClass("active");
                $("#type").val("sample");
                $("#customization_section").show(); 

            });
            $(".details_btn2").click(function(){
                $(".order_details").removeClass("active");
                $(".buy_production").addClass("active");
                $(this).addClass("active");
                $(".details_btn1").removeClass("active");
                $("#type").val("production");
                $("#customization_section").hide();

            });

            $("#customization_check").change(function(){
                if( $(this).prop('checked') == true ) {
                    $("#customization").show();
                }
                else {
                    $("#customization").hide();
                }
            }); 
        });

        function validateNumber(evt) {
            validateQuantity(evt);
        }

        function validateQuantity(evt) {

            $("#form_error").html("");

            var no =  parseInt( evt.value );
            if( isNaN(no) || no < 1 ) {
                evt.value = "0";
                return;
            }

            evt.value = parseInt(evt.value);

            // var quantity = parseInt($("#quantity").val());
             var quantity = parseInt(evt.value);

            if(evt.value) {
                $("#price_table").css('display','');
                $("#price_table_quantity").html( quantity );
                $("#price_table_amount").html( amount*quantity );

            }
            else {
                $("#price_table").css('display','none');
            }

            

            $(".fabric-type-price").each( (index,obj) => {
                var amt = obj.childNodes[3].getAttribute('amount');
                obj.childNodes[3].innerHTML = parseFloat(amt)*parseFloat(quantity);
                amt = obj.childNodes[5].getAttribute('amount');
                obj.childNodes[5].innerHTML = parseFloat(amt)*parseFloat(quantity);
            });
            console.log("--- ");
        }

        function submitCart() {
            var quantity = $("#quantity").val();
            quantity = parseInt(quantity);

            var customization = $("#customization").val();

            amount  = parseFloat(amount);
            var size_abbr =  $('#size_abbr').html();

            var production_quantity = parseInt($("#production_quantity").val());


            if(isNaN(quantity) || isNaN(amount) ) {
                $("#form_error").html("Please fill form properly");
                return false;
            }

            $("#form_production_quantity").val(production_quantity)
            console.log(production_quantity);

            $("#form_size").val(size_abbr);
            $("#form_quantity").val(quantity);
            $("#form_amount").val(quantity * amount);
            $("#form_customization").val(customization); 

            return true;
        }

        function changeSize(evt) {
            $('#size_abbr').html(evt.value);
        }


        function wishlist(id)
        {
            $.ajax({
                url: '/ajax/product/'+id+'/wishlist',
                method : 'post',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    // need to show message anywhere. 
                    if(response.status)
                    {

                    } // window.location.reload(); 
                }
            }); 
            return false;
        }

    </script>
    @endif 

@endsection