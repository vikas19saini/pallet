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
                        <div class="preview col">
                            <div class="app-figure" id="zoom-fig">
                               <a id="Zoom-1" class="MagicZoom" href="{{  url( 'img/product-images/'.$product->primary_image) }}"
                                  data-zoom-image-2x="{{  url( 'img/product-images/'.$product->primary_image) }}"
                                  data-image-2x="{{  url( 'img/product-images/'.$product->primary_image) }}">
                               <img src="{{  url( 'img/product-images/'.$product->primary_image) }}" alt=""/></a>
                               <div class="selectors">
                                  @foreach($productImages as $image)
                                    @if(is_string($image))
                                    <a data-zoom-id="Zoom-1" href="{{ url('img/product-images/'.trim($image)) }}"
                                       data-image-2x="{{ url('img/product-images/'.trim($image)) }}">
                                    <img src="{{ url('img/product-images/'.trim($image)) }}"/>
                                    </a>
                                    @else
                                    <a data-zoom-id="Zoom-1" href="{{ url($image->location) }}"
                                       data-image-2x="{{ url($image->location) }}">
                                    <img src="{{ url($image->location) }}"/>
                                    </a>
                                    @endif 
                                  @endforeach
								  <a data-zoom-id="Zoom-1" href="{{  url( 'img/product-images/'.$product->primary_image) }}"
                                       data-image-2x="{{  url( 'img/product-images/'.$product->primary_image) }}">
                                    <img src="{{  url( 'img/product-images/'.$product->primary_image) }}"/>
                                    </a>
                               </div>
                            </div>
                         </div>
                        
                    </div>
                    <div class="product_details_right">
                        <span>
                            {{-- <span class="add-fav pull-right" style="cursor: pointer"> 
                                <i class="fa fa-heart" style="color: red"></i>
                            </span> --}} 
                             {{ $product->product_key }}
                        </span>
                        <h2> {{ $product->title }} <span> {{ $product->tagline }}</span></h2>
                        <p>$ {{ $product->amount }}</p>
                        <div class="color_section">

                                {{-- @foreach($product->productColors as $item)
                                    <span style="background-color: #{{$item->color_code}}"></span>
                                @endforeach  --}}

                            <!-- </p> -->
                                <div class="form-group">
                                <label for="select_size">Select Fabric</label>
                                <select id="select-fabric-type" class="select_size form-control">
                                    @foreach($product->product_has_fabrics as $item)
                                        <option value="{{$item->fabric_id}}">{{ $item->fabric->name }}</option>
                                    @endforeach 
                                </select> 
                                </div>
                            <h2 class="product_h2">Product Description</h2>
                            <p>
                                {{ $product->description }}
                            </p>

                        </div>
                        <div class="details_section">
                            <div class="details_btn">
                                <button class="details_btn1 active">ORDER SAMPLE</button>
                                <button class="details_btn2">BUY PRODUCTION</button>
                                <button class="details_btn3">CUSTOMIZATION</button>
                            </div>
                            <div class="dishide">
                            <p>When you order sample the products get de-listed from website for 14 days. If the production order is not placed within 14 days the product gets again listed for others.</p>

                            <table class="table table-bordered" id="fabric_price_table" style="margin-top: 15px">
                                <tr>
                                    <td> Fabric </td>
                                    <td> Sample Price (3 pieces) </td>
                                    <td> Production Price </td>
                                </tr>
                                
                                @foreach($product->product_has_fabrics as $item)
                                    <tr class="fabric-type-price" id="{{ 'fabric-type-'.$item->fabric_id }}">
                                        <td val="tag-{{ $item->fabric_id }}"> {{ $item->fabric ? $item->fabric->name : '' }} </td>
                                        <td factor="{{ $item->amount }}" amount="{{ $product->price }}"> ${{ $product->amount }} </td>
                                        <td factor="{{ $item->amount }}" amount="{{ $product->price }}"> ${{ $product->amount }} </td>
                                    </tr>
                                @endforeach 
                            
                            </table>

                            <div class="size_details">
                                <span>Select Quantity</span>
                                <div class="select_size">
<!--                                    <span>
                                        <b id="size_abbr"> M </b>
                                        <select id="size" name="size" onchange="changeSize(this)">
                                        <option value="S">Small Size</option>
                                        <option value="M">Medium Size</option>
                                        <option value="L">Large Size</option>
                                        <option value="XL">Extra Large Size</option>
                                        </select>
                                    </span>-->
                                    <span class="order_details active" style="width: auto;padding-left: 10px;border: 1px solid #777;border-radius: 4px;color:#777">
                                        <input readonly onchange="return validateQuantity(this)" onkeyup="return validateNumber(this)" type="text" value="3" name="quantity" id="quantity" style="outline: none; border: 0px;-webkit-appearance: none;width:10px;color:#777"/>
                                        Pieces (Fixed for sample orders)
                                    </span>
                                    <span class="buy_production" style="margin-left: 0px; width: auto;border: 1px solid #777;border-radius: 4px;">
                                        <select name="production_quantity" id="production_quantity" onchange="return validateQuantity(this)"><i class="fa fa-angle-down" aria-hidden="true"></i>
                                            <option value="-1" data-discount='0'>Select Quantity</option>
                                            <option value="24" data-discount="15">24 Pieces</option>
                                            <option value="36" data-discount="17.5">36 Pieces</option>
                                            <option value="48" data-discount="20">48 Pieces</option>
                                            <option value="60" data-discount="22.5">60 Pieces</option>
                                            <option value="72" data-discount="25">72 Pieces</option>
                                            <option value="84" data-discount="27.5">84 Pieces</option>
                                            <option value="96" data-discount="30">96 Pieces</option>
                                            <option value="more" data-discount="0">More</option>
                                        </select>
                                    </span>
                                </div>

                                <p>One size fits all</p>
                            </div>
                            
                            
                            <table class="table table-bordered" id="price_table" style="display: none">
                                <tr>
                                    <td> Quantity </td>
                                    <td> Price </td>
                                </tr>
                                <tr>
                                    <td id="price_table_quantity">  </td>
                                    <td id="price_table_amount">  </td>
                                </tr>
                            </table>

                            <div>
                                <form action="" name="form_cart_add" id="form_cart_add" method="post" onsubmit="return submitCart()">
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6 pad_left">
                                            <div class="add_cart">
                                                <button style="width: 60%">ADD TO CART</button>
                                            </div>
                                            <div class="add_cart">
                                                <button onclick="return wishlist({{ $product->id }});" id="wishlist_label_btn" style="width: 60%">ADD TO WISHLIST</button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                   
                                    <span id="form_error" style="color: red;" ></span>
                                    <input type="hidden" name="fabric_id" id="fabric_id" />
                                    <input type="hidden" name="amount" id="form_amount" />
                                    <input type="hidden" name="type" id="type" value="sample" />
                                    <input type="hidden" name="production_quantity" id="form_production_quantity" />
                                    <input type="hidden" name="quantity" id="form_quantity" />
                                    <input type="hidden" name="size" id="form_size" />
                                    <input type="hidden" name="form_customization" id="form_customization" />
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                    <input type="hidden" name="discount" value="0" id="product_discount" />
                                    {{ csrf_field() }}
                                </form>
                            </div>
                            </div>
                                <div class="customise_sec">
                                    <form method="post" action="/product/customization" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <input type="hidden" value="{{ $product->slug }}" name="redirect">
                                        <h5>Customization Details</h5>   
                                        <textarea name="note" rows="6" required style="width: 100%;padding: 10px;" placeholder="Customization Note"></textarea>
                                        <div id="customization_section"> 
                                            <div class="check_aria">
                                                <input id="customization_check" type="checkbox">  
                                                Do you have your own Design/Product?
                                            </div>
                                            <div style="display:none;padding:0 0 10px" id="customization">
                                                <input name="image" type='file' />
                                            </div>
                                            <div class="check_aria">
                                                <input type="checkbox" name="fabric_customize" value="yes">  
                                                Do you need Fabric customization?
                                            </div>
                                            <div class="check_aria">
                                                <input type="checkbox" name="print_customize" value="yes">  
                                                Do you need Print Customization?
                                            </div>
                                            <div class="check_aria">
                                                <input type="checkbox" name="size_customize" value="yes">  
                                                Do you need Size customization?
                                            </div>
                                        </div>
                                        <button class="sub_bttn">Submit</button>
                                    </form>
                                </div>
                            </div>          
                            
                        </div>
                    </div>
                    @else
                        <h2 style="margin-left: auto;margin-right: auto"> Product is not available. </h2>
                    @endif

                </div>
            </div>
            @endif 
</section>

<!-- Modal -->
<div class="modal fade" id="more_product_quantity_enquiry" role="dialog" data-backdrop="static">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Product Enquiry</h4>
            </div>
            <div class="modal-body">
                <p>Looking for more than 96 pieces ?</p>
                <form method="post" action="{{ url('save_more_quantity_request') }}">
                    @csrf
                    <input type="number" name="quantity" required placeholder="Mention quantity " min="97" autocomplete="off">
                    <input type="hidden" name="product_id" value="{{ $product->id }}" readonly>
                    <input type="hidden" name="product_name" value="{{ $product->title }}" readonly>
                    <input type="hidden" name="redirect" value="{{ $product->slug }}" readonly>
                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

    @if(!(isset($status) && $status === false))
        @include('includes.related')
    @endif 

@endsection

@section('pageLevelJS')


    @if(!(isset($status) && $status === false))
    <script>
                                
        var amount  = {{ $product->amount }};
        var product_id = {{ $product->id }}; 
        var priceList = {!! json_encode($fabricPrices) !!};

                
        priceList.forEach(item => {
            console.log(item); 
        })

        var start_percentage = {{ $product->start_percentage }}; 
        var end_percentage = {{ $product->end_percentage }}; 
        var range_start  = {{ $product->range_start }}; 
        var range_end = {{  $product->range_end }}; 

        $(document).ready(function() {

            $(".add-fav").click(function(){
                $.ajax({
                    url: '/ajax/product/'+product_id+'/favourites',
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
            });

            $('.product_details_small>img').click(function(){
                $(this).addClass("active");
                $(this).siblings().removeClass("active")
                var dataImg = $(this).attr("data-img");
                $(".dynamic_img").attr("src", dataImg);
                $("#quantity").val(1);
            });
            $('.details_btn1').click(function(){
                $(".customise_sec").css("display", 'none');
                $(".dishide").css("display", 'block');
                $(".order_details").addClass("active");
                $(".buy_production").removeClass("active");
                $(this).addClass("active");
                $(".details_btn2").removeClass("active");
                $(".details_btn3").removeClass("active");
                $("#type").val("sample");
                

            });
            $('.details_btn2').click(function(){
                $(".customise_sec").css("display", 'none');
                $(".dishide").css("display", 'block');        
                $(".order_details").removeClass("active");
                $(".buy_production").addClass("active");
                $(this).addClass("active");
                $(".details_btn1").removeClass("active");
                $(".details_btn3").removeClass("active");
                $("#type").val("production");
               

            });
            $('.details_btn3').click(function(){
                $(".customise_sec").addClass("active");
                $(".dishide").css("display", 'none');            
                $(".customise_sec").css("display", 'block');
                $(".details_btn2").removeClass("active");
                $(".details_btn3").addClass("active");
                $(this).addClass("active");
                
            });

            $('#customization_check').change(function(){
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
        
            if(evt.value === 'more'){
                $(".add_cart").children('button').attr('disabled', true);
                $('#more_product_quantity_enquiry').modal('show');
                return false;
            }else{
                $(".add_cart").children('button').attr('disabled', false);
            }

            var fabric_id = $('#select-fabric-type').val();            
            $('#fabric_id').val(fabric_id);

            $('#form_error').html('');

            var no =  parseInt( evt.value );
            if( isNaN(no) || no < 1 ) {
                evt.value = "0";
                return;
            }

            evt.value = parseInt(evt.value);

            var quantity = parseInt(evt.value);
            $('.fabric-type-price').each( (index, obj) => {

                amt = priceList[index].amount * amount;
                obj.childNodes[3].innerHTML = '$' + parseFloat(amt).toFixed(2);
                amt = parseFloat(amt); 

                var final_discount = 0; 
                if(quantity < range_start)
                {
                    final_discount = 0; 
                }
                else if(quantity == range_start)
                {
                    final_discount = start_percentage; 
                }
                else if(quantity >= range_end ) 
                {
                    final_discount = end_percentage;
                }
                else {
                    var range_percentage =  end_percentage - start_percentage;
                    var range_divider = range_end - range_start; 
                    final_discount = (quantity - range_start) * range_percentage/range_divider; 
                }

                final_discount = $('#production_quantity :selected').data('discount');

                // where price index amount is factor of multiply based on fabric 
                amt =  (amt/3) * (100-final_discount) / 100;

                obj.childNodes[5].innerHTML = '$' + parseFloat(parseFloat(amt) * parseFloat(quantity)).toFixed(2);
            });
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

            var fabric_id = $('#select-fabric-type').val();
            $('#form_production_quantity').val(production_quantity)
            // console.log(production_quantity);

            $('#form_size').val(size_abbr);
            $('#fabric_id').val(fabric_id);
            $('#form_quantity').val(quantity);
            $('#form_amount').val(quantity * amount);
            $('#form_customization').val(customization);
            $('#product_discount').val($('#production_quantity :selected').data('discount'));

            // console.log(document.forms['submitCart']); 

            // e.preventDefault();

            $.ajax({
                type: 'post',
                url: "{{ url('/ajax/cart/new') }}",
                data: $('form').serialize(),
                success: function () {
                    window.location.href = "{{ url('cart')}}"; 
                }
            });


            return false;
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
<script>
var mzOptions = {
zoomMode: "off",
zoomOn: "click"
};
</script>

    @endif 

@endsection