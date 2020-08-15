@extends('layouts.app')

@section('pageLevelCSS')
<link rel="stylesheet" href="{{ url('css_new/style.css') }}">
@endsection

@section('content')

<section class="product_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hm_pro">
                    <p><a href="/">Home</a>/<a href="/{{ $product->category->slug }}/c">{{ $product->category->name }}</a>/<a href="/{{ $product->slug }}/p">{{ $product->title }}</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div id="product_dtl" class="img_custom owl-carousel">
                    <div class="item">
                        <div>
                            <img src="{{  url( 'img/product-images/'.$product->primary_image) }}" class="img-fluid productImage" data-toggle="modal" data-target="#productZoom" data-pos="0">
                        </div>
                    </div>
                    @foreach($productImages as $image)
                    @if(is_string($image))
                    <div class="item">
                        <div>
                            <img src="{{ url('img/product-images/'.trim($image)) }}" class="img-fluid productImage" data-toggle="modal" data-target="#productZoom" data-pos="0">
                        </div>
                    </div>
                    @else
                    <div class="item">
                        <div>
                            <img src="{{ url($image->location) }}" class="img-fluid" data-toggle="modal productImage" data-target="#productZoom" data-pos="0">
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6">
                <div class="main_pro">
                    <div class="inner_detail">
                        <h5>{{ $product->category->name }}</h5>
                        <button type="button" class="bttn_wish" onclick="return wishlist({{ $product->id }})">
                            <img src="{{ url('img/heart.png') }}">
                            <span>Wishlist</span>
                        </button>
                        <h3>{{ $product->title }}</h3>
                        <p class="desk_view">{{ $product->tagline }}</p>
                        <div class="mob_view">
                            <div class="row">
                                <div class="col-xs-12 padd">
                                    <div class="inner_price">
                                        <p>Price <span><i class="fa fa-usd" aria-hidden="true"></i>{{ $product->amount }}</span>
                                            <span class="price_tx">(For 3 Pieces)</span></p>
                                    </div>
                                </div>

                            </div>
                            <div class="row rw_1">
                                <div class="col-xs-6 bdr_left_right">
                                    <div class="inner_pieces">
                                        <p>Pieces Created <span>{{ $product->total_created }}</span></p>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="inner_pieces">
                                        <p>In Stock<span>{{ $product->total_quantity }} Left</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="desk_view">
                            @if(!empty($product->how_upcycle))
                            <div class="inner_more">
                                <p>How did we Upcycle ? <span><a href="#knowHowUpCycle">Know More</a></span></p>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-5 padd">
                                    <div class="inner_price">
                                        <p id="updated_price">Price
                                            <span>
                                                <i class="fa fa-usd" aria-hidden="true"></i>
                                                {{ $product->amount }}
                                                <strong class="price_tx"> (For 3 Pieces)</strong>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-7 padd">
                                    <div class="inner_quitity">
                                        <p>Select Quantity:</p>
                                        <div class="input-group select_quitity">
                                            <span class="input-group-btn">
                                                <button type="button" onClick="minusQuantity()" class="quantity-left-minus btn btn-danger btn-number">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity" readonly class="form-control input-number" value="3" min="3">
                                            <span class="input-group-btn">
                                                <button type="button" onClick="plusQuantity()" class="quantity-right-plus btn btn-success btn-number">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 padd">
                                    <div class="inner_pieces">
                                        <p>Pieces Created <span>{{ $product->totalCreated }}</span></p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 padd">
                                    <div class="inner_pieces bdr_left">
                                        <p>In Stock<span>{{ $product->totalQuantity }} Left</span></p>
                                    </div>
                                </div>
                                <!-- To handle add to cart !-->
                                <select id="select-fabric-type" class="select_size form-control" style="display: none;">
                                    @foreach($product->product_has_fabrics as $item)
                                    <option value="{{$item->fabric_id}}">{{ $item->fabric->name }}</option>
                                    @endforeach
                                </select>
                                <form action="" name="form_cart_add" id="form_cart_add" method="post" onsubmit="return submitCart()">
                                    <span id="form_error" style="color: red;"></span>
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
                                <!-- Handle add to cart end !-->
                                <div class="col-lg-6">
                                    <div class="cart_bttn">
                                        <button type="button" class="add_cart" onclick="$('#form_cart_add').submit()">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!empty($product->dimension))
                        <div class="dimesion_detail desk_view">
                            <p>Dimension</p>
                            <p>{{ $product->dimension }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="inter_check">
                        <div class="row">
                            <div class="col-md-6 padd">
                                <div class="check_input">
                                    <label for="fname">DELIVERY OPTIONS</label>
                                    <div class="bttm_bdr">
                                        <input type="text" id="fname" placeholder="Please enter PIN code">
                                        <span><a href="#">Check</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 padd desk_view">
                                <div class="check_input">
                                    <label for="fname"><img src="{{ url('img/truck.png') }}"> Free shipping</label>
                                    <div class="bttm_bdr">
                                        <input type="text" id="fname" placeholder="Please enter PIN code to check delivery time">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="product-enquiry">
                        <h4>Need help with this product?</h4>
                        <div class="engroup">
                            <a target="_blank" href="tel:011-46614444">
                                <div>
                                    <i class="fa fa-mobile" aria-hidden="true"></i>
                                    <p>Give us a call</p>
                                    <span>Mon - Sat | 9 AM to 6 PM</span>
                                </div>
                            </a>
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=+919711073447">
                                <div>
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                    <p>Chat with us on WhatsApp</p>
                                    <span>Mon - Sat | 9 AM to 6 PM</span>
                                </div>
                            </a>
                            <a target="_blank" href="mailto:raghav@hpsingh.com">
                                <div>
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <p>Drop us an email</p>
                                    <span>We'll get back to you within 24 hours</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="detail_sec_bdr">
                    <div class="accordion acco_head">
                        @if(!empty($product->description))
                        <h4 class="accordion-toggle active">Product Description </h4>
                        <div class="accordion-content footer_menu1" style="display: block">
                            <p>{{ $product->description }}</p>
                        </div>
                        @endif

                        @if(!empty($product->how_upcycle))
                        <h4 class="accordion-toggle" id="knowHowUpCycle">How Did We Upcycle ?</h4>
                        <div class="accordion-content footer_menu1">
                            <p>{{ $product->how_upcycle }}</p>
                        </div>
                        @endif

                        @if(!empty($product->dimension))
                        <h4 class="accordion-toggle">Dimension/Size</h4>
                        <div class="accordion-content footer_menu1">
                            <p>{{ $product->dimension }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$catId = isset($product) && $product ? $product->product_category_id : '';
$relatedItems = App\Http\Controllers\ProductCtrl::relatedItems($catId);
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="you_make">
                    <h6>YOU MAY ALSO LIKE / RECENTLY VIEWED</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="product_detail" class="img_custom owl-carousel">
                    @foreach($relatedItems as $product)
                    <div class="item">
                        <div class="">
                            <a href="/{{ $product->slug }}/p">
                                <img src="{{ url( is_numeric($product->primary_image) ? ($product->image_primary ? $product->image_primary->location : '#') : 'img/product-images/'.$product->primary_image ) }}" class="img-responsive" />
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="productZoom" role="dialog" style="overflow: hidden;max-width:980px;margin: 0 auto;padding-right: 0px">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="popup_section1 zoom" id="large-image">
                <img src="images/img_1.png" class="dynamic_img">
            </div>
        </div>
        <div class="popup_section2" style="overflow: hidden">
            <div class="close_popup" data-dismiss="modal"></div>
            <div class="popup_section2_img">
                <img src="{{  url( 'img/product-images/'.$product->primary_image) }}" class="img-responsive productBigThumbs" />
                @foreach($productImages as $image)
                @if(is_string($image))
                <img src="{{ url('img/product-images/'.trim($image)) }}" class="img-responsive productBigThumbs" />
                @else
                <img src="{{ url($image->location) }}" class="img-responsive productBigThumbs" />
                @endif
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection

@section('pageLevelJS')
<script src="{{ url('js/zoom.min.js') }}"></script>
<script>
    $(".productBigThumbs").click(function() {
        $(".productBigThumbs").removeClass('active');
        $(this).addClass('active');
        $("#large-image").children('img').attr('src', $(this).attr('src'));
        $("#large-image").zoom();
    });
    $(".productImage").click(function() {
        $("#large-image").children('img').attr('src', $(this).attr('src'));
        $("#large-image").zoom();
    });
</script>

@if(!(isset($status) && $status === false))
<script>
    var amount = <?= $product->amount ?>;
    var product_id = <?= $product->id ?>;
    var priceList = <?= json_encode($fabricPrices) ?>;

    var start_percentage = <?= $product->start_percentage ?>;
    var end_percentage = <?= $product->end_percentage ?>;
    var range_start = <?= $product->range_start ?>;
    var range_end = <?= $product->range_end ?>;
    var discounts = [{
            quantity: 3,
            discount: 0
        }, {
            quantity: 24,
            discount: 15
        }, {
            quantity: 36,
            discount: 17.5
        }, {
            quantity: 48,
            discount: 20
        }, {
            quantity: 60,
            discount: 22.5
        }, {
            quantity: 72,
            discount: 25
        },
        {
            quantity: 84,
            discount: 27.5
        },
        {
            quantity: 96,
            discount: 30
        }
    ]

    function plusQuantity() {
        var currentQuantity = parseInt($("#quantity").val());

        var index = discounts.map(function(e) {
            return e.quantity;
        }).indexOf(currentQuantity);

        if (index === (discounts.length - 1)) {
            return;
        }

        $("#quantity").val(discounts[index + 1].quantity);
        $("#product_discount").val(discounts[index + 1].discount)
        $("#quantity").trigger('change');
    }

    function minusQuantity() {
        var currentQuantity = parseInt($("#quantity").val());

        var index = discounts.map(function(e) {
            return e.quantity;
        }).indexOf(currentQuantity);

        if (index === 0) {
            return;
        }

        $("#quantity").val(discounts[index - 1].quantity);
        $("#product_discount").val(discounts[index - 1].discount)
        $("#quantity").trigger('change');
    }

    $(document).ready(function() {
        $(".add-fav").click(function() {
            $.ajax({
                url: '/ajax/product/' + product_id + '/favourites',
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // need to show message anywhere. 
                    if (response.status) {

                    } // window.location.reload(); 
                }
            });
            return false;
        });
    });

    $("#quantity").change(function() {
        amt = priceList[0].amount * amount;
        amt = parseFloat(amt);
        var quantity = parseFloat($(this).val());

        /* var final_discount = 0;
        if (quantity < range_start) {
            final_discount = 0;
        } else if (quantity == range_start) {
            final_discount = start_percentage;
        } else if (quantity >= range_end) {
            final_discount = end_percentage;
        } else {
            var range_percentage = end_percentage - start_percentage;
            var range_divider = range_end - range_start;
            final_discount = (quantity - range_start) * range_percentage / range_divider;
        } */

        final_discount = parseFloat($("#product_discount").val());

        amt = (amt / 3) * (100 - final_discount) / 100;
        var finalAmount = parseFloat(parseFloat(amt) * parseFloat(quantity)).toFixed(2);
        $("#updated_price").replaceWith(`<p id="updated_price">Price<span><i class="fa fa-usd" aria-hidden="true"></i>${finalAmount}<strong class="price_tx"> (For ${quantity} Pieces)</strong></span></p>`);
    });

    function submitCart() {
        var quantity = $("#quantity").val();
        quantity = parseInt(quantity);

        if (quantity > 3) {
            $('#form_production_quantity').val(quantity);
            $('#form_quantity').val(3);
            $("#type").val("production");
        } else {
            $('#form_quantity').val(quantity);
            $("#type").val("sample");
        }

        amount = parseFloat(amount);

        if (isNaN(quantity) || isNaN(amount)) {
            $("#form_error").html("Please fill form properly");
            return false;
        }

        var fabric_id = $('#select-fabric-type').val();


        $('#fabric_id').val(fabric_id);
        $('#form_amount').val(quantity * amount);

        $.ajax({
            type: 'post',
            url: "{{ url('/ajax/cart/new') }}",
            data: $('form').serialize(),
            success: function() {
                window.location.href = "{{ url('cart')}}";
            }
        });
        return false;
    }

    function changeSize(evt) {
        $('#size_abbr').html(evt.value);
    }


    function wishlist(id) {
        $.ajax({
            url: '/ajax/product/' + id + '/wishlist',
            method: 'post',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                window.location.reload();
            }
        });
    }
</script>
<script>
    var mzOptions = {
        zoomMode: "off",
        zoomOn: "click"
    };
</script>
<script>
    $('#product_detail').owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive: {
            1024: {
                items: 3,
                margin: 70,
            },
            667: {
                items: 2.2,
            },
            640: {
                items: 2.2,
            },
            0: {
                items: 1.3,
                margin: 40,
            }
        }
    });
    $('#product_dtl').owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive: {
            1024: {
                items: 1,
                margin: 70,
            },

            667: {
                items: 1,
            },
            640: {
                items: 1,
            },
            0: {
                items: 1,
                margin: 40,
            }
        }
    });
</script>
@endif

@endsection