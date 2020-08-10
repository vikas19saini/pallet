<?php $__env->startSection('pageLevelCSS'); ?>
<link rel="stylesheet" href="<?php echo e(url('css_new/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="product_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hm_pro">
                    <p><a href="/">Home</a>/<a href="/<?php echo e($product->category->slug); ?>/c"><?php echo e($product->category->name); ?></a>/<a href="/<?php echo e($product->slug); ?>/p"><?php echo e($product->title); ?></a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="productWrapper group">
                    <div class="gallery-wrapper">
                        <div id="zoom-box" data-view="zoom" class="zoom-box image-item">
                            <div class="Sirv" id="zoom1" data-effect="zoom" data-options="thumbnails: #thumbs-box; square-thumbnails: false; fade: false;">
                                <?php $__currentLoopData = $productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(is_string($image)): ?>
                                <img data-src="<?php echo e(url('img/product-images/'.trim($image))); ?>" />
                                <?php else: ?>
                                <img data-src="<?php echo e(url($image->location)); ?>" />
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <img data-src="<?php echo e(url( 'img/product-images/'.$product->primary_image)); ?>" />
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnails -->
                    <div id="thumbs-box" class="thumbs-box"></div>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="main_pro">
                    <div class="inner_detail">
                        <h5><?php echo e($product->category->name); ?></h5>
                        <button type="button" class="bttn_wish" onclick="return wishlist(<?php echo e($product->id); ?>)">
                            <img src="<?php echo e(url('img/heart.png')); ?>">
                            <span>Wishlist</span>
                        </button>
                        <h3><?php echo e($product->title); ?></h3>
                        <p class="desk_view"><?php echo e($product->tagline); ?></p>
                        <div class="mob_view">
                            <div class="row">
                                <div class="col-xs-12 padd">
                                    <div class="inner_price">
                                        <p>Price <span><i class="fa fa-usd" aria-hidden="true"></i><?php echo e($product->amount); ?></span>
                                            <span class="price_tx">(For 3 Pieces)</span></p>
                                    </div>
                                </div>

                            </div>
                            <div class="row rw_1">
                                <div class="col-xs-6 bdr_left_right">
                                    <div class="inner_pieces">
                                        <p>Pieces Created <span><?php echo e($product->totalCreated); ?></span></p>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="inner_pieces">
                                        <p>In Stock<span><?php echo e($product->totalQuantity); ?> Left</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 padd">
                                    <div class="inner_quitity">
                                        <p>Quantity:</p>
                                        <div class="input-group select_quitity">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="12" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class=""><button type="button" class="add_cart">Add to Cart</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="desk_view">
                            <div class="inner_more">
                                <p>How did we Upcycle ? <span><a href="#">Know More</a></span></p>
                            </div>
                            <div class="row">
                                <div class="col-md-5 padd">
                                    <div class="inner_price">
                                        <p>Price <span><i class="fa fa-usd" aria-hidden="true"></i><?php echo e($product->amount); ?> <strong class="price_tx">(For 3 Pieces)</strong></span></p>
                                    </div>
                                </div>
                                <div class="col-md-7 padd">
                                    <div class="inner_quitity">
                                        <p>Select Quantity:</p>
                                        <div class="input-group select_quitity">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="12" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
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
                                        <p>Pieces Created <span><?php echo e($product->totalCreated); ?></span></p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 padd">
                                    <div class="inner_pieces bdr_left">
                                        <p>In Stock<span><?php echo e($product->totalQuantity); ?> Left</span></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="cart_bttn"><button type="button" class="add_cart">Add to
                                            Cart</button></div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($product->dimension)): ?>
                        <div class="dimesion_detail desk_view">
                            <p>Dimension</p>
                            <p><?php echo e($product->dimension); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- <div class="inter_check">
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
                                    <label for="fname"><img src="<?php echo e(url('img/truck.png')); ?>"> Free shipping</label>
                                    <div class="bttm_bdr">
                                        <input type="text" id="fname" placeholder="Please enter PIN code to check delivery time">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->



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
                        <?php if(!empty($product->description)): ?>
                        <h4 class="accordion-toggle active">Product Description </h4>
                        <div class="accordion-content footer_menu1" style="display: block">
                            <p><?php echo e($product->description); ?></p>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($product->howUpcycle)): ?>
                        <h4 class="accordion-toggle">How Did We Upcycle ?</h4>
                        <div class="accordion-content footer_menu1">
                            <p><?php echo e($product->howUpcycle); ?></p>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($product->dimension)): ?>
                        <h4 class="accordion-toggle">Dimension/Size</h4>
                        <div class="accordion-content footer_menu1">
                            <p><?php echo e($product->dimension); ?></p>
                        </div>
                        <?php endif; ?>
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
                    <?php $__currentLoopData = $relatedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="">
                            <a href="/<?php echo e($product->slug); ?>/p">
                                <img src="<?php echo e(url( is_numeric($product->primary_image) ? ($product->image_primary ? $product->image_primary->location : '#') : 'img/product-images/'.$product->primary_image )); ?>" class="img-responsive" />
                            </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product_details">
    <div class="container">

        <?php if(isset($status) && $status === false): ?>
        <div class="row">
            <center style="padding: 300px 100px;font-size: xx-large;">
                <?php echo e($message); ?>

                <br />
                status code - 410
                </h2>
        </div>
        <?php else: ?>
        <div class="row">
            <h2>Home > <?php echo e($product->category->name); ?>> <?php echo e($product->product_key); ?></h2>
            <div class="product_details_main">

                <?php if($product->status == 'LISTED'): ?>
                <div class="product_details_left">
                    <div class="preview col">
                        <div class="app-figure" id="zoom-fig">
                            <a id="Zoom-1" class="MagicZoom" href="<?php echo e(url( 'img/product-images/'.$product->primary_image)); ?>" data-zoom-image-2x="<?php echo e(url( 'img/product-images/'.$product->primary_image)); ?>" data-image-2x="<?php echo e(url( 'img/product-images/'.$product->primary_image)); ?>">
                                <img src="<?php echo e(url( 'img/product-images/'.$product->primary_image)); ?>" alt="" /></a>
                            <div class="selectors">
                                <?php $__currentLoopData = $productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(is_string($image)): ?>
                                <a data-zoom-id="Zoom-1" href="<?php echo e(url('img/product-images/'.trim($image))); ?>" data-image-2x="<?php echo e(url('img/product-images/'.trim($image))); ?>">
                                    <img src="<?php echo e(url('img/product-images/'.trim($image))); ?>" />
                                </a>
                                <?php else: ?>
                                <a data-zoom-id="Zoom-1" href="<?php echo e(url($image->location)); ?>" data-image-2x="<?php echo e(url($image->location)); ?>">
                                    <img src="<?php echo e(url($image->location)); ?>" />
                                </a>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <a data-zoom-id="Zoom-1" href="<?php echo e(url( 'img/product-images/'.$product->primary_image)); ?>" data-image-2x="<?php echo e(url( 'img/product-images/'.$product->primary_image)); ?>">
                                    <img src="<?php echo e(url( 'img/product-images/'.$product->primary_image)); ?>" />
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="product_details_right">
                    <span>
                        
                        <?php echo e($product->product_key); ?>

                    </span>
                    <h2> <?php echo e($product->title); ?> <span> <?php echo e($product->tagline); ?></span></h2>
                    <p>$ <?php echo e($product->amount); ?></p>
                    <div class="color_section">

                        

                        <!-- </p> -->
                        <div class="form-group">
                            <label for="select_size">Select Fabric</label>
                            <select id="select-fabric-type" class="select_size form-control">
                                <?php $__currentLoopData = $product->product_has_fabrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->fabric_id); ?>"><?php echo e($item->fabric->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <h2 class="product_h2">Product Description</h2>
                        <p>
                            <?php echo e($product->description); ?>

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

                                <?php $__currentLoopData = $product->product_has_fabrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="fabric-type-price" id="<?php echo e('fabric-type-'.$item->fabric_id); ?>">
                                    <td val="tag-<?php echo e($item->fabric_id); ?>"> <?php echo e($item->fabric ? $item->fabric->name : ''); ?> </td>
                                    <td factor="<?php echo e($item->amount); ?>" amount="<?php echo e($product->price); ?>"> $<?php echo e($product->amount); ?> </td>
                                    <td factor="<?php echo e($item->amount); ?>" amount="<?php echo e($product->price); ?>"> $<?php echo e($product->amount); ?> </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </table>

                            <div class="size_details">
                                <span>Select Quantity</span>
                                <div class="select_size">
                                    <span class="order_details active" style="width: auto;padding-left: 10px;border: 1px solid #777;border-radius: 4px;color:#777">
                                        <input readonly onchange="return validateQuantity(this)" onkeyup="return validateNumber(this)" type="text" value="3" name="quantity" id="quantity" style="outline: none; border: 0px;-webkit-appearance: none;width:10px;color:#777" />
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
                                    <td id="price_table_quantity"> </td>
                                    <td id="price_table_amount"> </td>
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
                                                <button onclick="return wishlist(<?php echo e($product->id); ?>);" id="wishlist_label_btn" style="width: 60%">ADD TO WISHLIST</button>
                                            </div>
                                        </div>

                                    </div>

                                    <span id="form_error" style="color: red;"></span>
                                    <input type="hidden" name="fabric_id" id="fabric_id" />
                                    <input type="hidden" name="amount" id="form_amount" />
                                    <input type="hidden" name="type" id="type" value="sample" />
                                    <input type="hidden" name="production_quantity" id="form_production_quantity" />
                                    <input type="hidden" name="quantity" id="form_quantity" />
                                    <input type="hidden" name="size" id="form_size" />
                                    <input type="hidden" name="form_customization" id="form_customization" />
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" />
                                    <input type="hidden" name="discount" value="0" id="product_discount" />
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php else: ?>
            <h2 style="margin-left: auto;margin-right: auto"> Product is not available. </h2>
            <?php endif; ?>

        </div>
    </div>
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageLevelJS'); ?>
<script type="text/javascript" src="https://scripts.sirv.com/sirv.js"></script>

<?php if(!(isset($status) && $status === false)): ?>
<script>
    var amount = <?= $product->amount ?>;
    var product_id = <?= $product->id ?>;
    var priceList = <?= json_encode($fabricPrices) ?>;

    var start_percentage = <?= $product->start_percentage ?>;
    var end_percentage = <?= $product->end_percentage ?>;
    var range_start = <?= $product->range_start ?>;
    var range_end = <?= $product->range_end ?>;

    $(document).ready(function() {
        $(".add-fav").click(function() {
            $.ajax({
                url: '/ajax/product/' + product_id + '/favourites',
                method: 'post',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    // need to show message anywhere. 
                    if (response.status) {

                    } // window.location.reload(); 
                }
            });
            return false;
        });

        $('.product_details_small>img').click(function() {
            $(this).addClass("active");
            $(this).siblings().removeClass("active")
            var dataImg = $(this).attr("data-img");
            $(".dynamic_img").attr("src", dataImg);
            $("#quantity").val(1);
        });
        $('.details_btn1').click(function() {
            $(".customise_sec").css("display", 'none');
            $(".dishide").css("display", 'block');
            $(".order_details").addClass("active");
            $(".buy_production").removeClass("active");
            $(this).addClass("active");
            $(".details_btn2").removeClass("active");
            $(".details_btn3").removeClass("active");
            $("#type").val("sample");


        });
        $('.details_btn2').click(function() {
            $(".customise_sec").css("display", 'none');
            $(".dishide").css("display", 'block');
            $(".order_details").removeClass("active");
            $(".buy_production").addClass("active");
            $(this).addClass("active");
            $(".details_btn1").removeClass("active");
            $(".details_btn3").removeClass("active");
            $("#type").val("production");


        });
        $('.details_btn3').click(function() {
            $(".customise_sec").addClass("active");
            $(".dishide").css("display", 'none');
            $(".customise_sec").css("display", 'block');
            $(".details_btn2").removeClass("active");
            $(".details_btn3").addClass("active");
            $(this).addClass("active");

        });

        $('#customization_check').change(function() {
            if ($(this).prop('checked') == true) {
                $("#customization").show();
            } else {
                $("#customization").hide();
            }
        });
    });

    function validateNumber(evt) {
        validateQuantity(evt);
    }

    function validateQuantity(evt) {

        if (evt.value === 'more') {
            $(".add_cart").children('button').attr('disabled', true);
            $('#more_product_quantity_enquiry').modal('show');
            return false;
        } else {
            $(".add_cart").children('button').attr('disabled', false);
        }

        var fabric_id = $('#select-fabric-type').val();
        $('#fabric_id').val(fabric_id);

        $('#form_error').html('');

        var no = parseInt(evt.value);
        if (isNaN(no) || no < 1) {
            evt.value = "0";
            return;
        }

        evt.value = parseInt(evt.value);

        var quantity = parseInt(evt.value);
        $('.fabric-type-price').each((index, obj) => {

            amt = priceList[index].amount * amount;
            obj.childNodes[3].innerHTML = '$' + parseFloat(amt).toFixed(2);
            amt = parseFloat(amt);

            var final_discount = 0;
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
            }

            final_discount = $('#production_quantity :selected').data('discount');

            // where price index amount is factor of multiply based on fabric 
            amt = (amt / 3) * (100 - final_discount) / 100;

            obj.childNodes[5].innerHTML = '$' + parseFloat(parseFloat(amt) * parseFloat(quantity)).toFixed(2);
        });
    }

    function submitCart() {
        var quantity = $("#quantity").val();
        quantity = parseInt(quantity);

        var customization = $("#customization").val();

        amount = parseFloat(amount);
        var size_abbr = $('#size_abbr').html();

        var production_quantity = parseInt($("#production_quantity").val());


        if (isNaN(quantity) || isNaN(amount)) {
            $("#form_error").html("Please fill form properly");
            return false;
        }

        var fabric_id = $('#select-fabric-type').val();
        $('#form_production_quantity').val(production_quantity)

        $('#form_size').val(size_abbr);
        $('#fabric_id').val(fabric_id);
        $('#form_quantity').val(quantity);
        $('#form_amount').val(quantity * amount);
        $('#form_customization').val(customization);
        $('#product_discount').val($('#production_quantity :selected').data('discount'));

        $.ajax({
            type: 'post',
            url: "<?php echo e(url('/ajax/cart/new')); ?>",
            data: $('form').serialize(),
            success: function() {
                window.location.href = "<?php echo e(url('cart')); ?>";
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
                _token: '<?php echo e(csrf_token()); ?>'
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
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>