<?php $__env->startSection('content'); ?>

<section class="cart_section">
    <div class="container">
        <div class="row">
            
            <div class="cart_area">
                <div class="cart_left">
                    <div class="cart_first">
                        <h2 style="margin-bottom: 0px">My Bag ( <count id="cart-total-item-count"> <?php echo e(count($cartItems)); ?> </count> item) </h2>
                    </div>

                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cart_first" id="cart-item-block-<?php echo e($item->id); ?>">
                        <div class="cart_img">
                            <img src="<?php echo e(url('img/product-images/' . $item->product->primary_image)); ?>" class="img-responsive">
                        </div>
                        <div class="cart_content">
                            <h3>
                                <?php echo e($item->product->title); ?> <span>(<?php echo e($item->product->product_key); ?>)</span>
                                <b>
                                    <?php echo e($item->order_type == "SAMPLE" ? "3 Pieces" : $item->quantity." Pieces"); ?>

                                </b>
                            </h3>
                            <p>
                                <?php echo e($item->product->tagline); ?> | <strong><?php echo e($item->order_type); ?></strong>
                            </p>
                            <p>Fabric: <?php echo e($item->fabrics->name); ?></p>
                            <span style="cursor: pointer" onclick="removeItemFrommCart(<?php echo e($item->id); ?>)">
                                <i class="fa fa-trash"> </i> Remove &nbsp;
                            </span>
                            <span>
                                <b id="cart-item-price-<?php echo e($item->id); ?>" val="<?php echo e($item->amount); ?>">
                                    $ <?php echo e($item->changeCurrencyFormat($item->amount, '$')); ?>

                                </b>
                            </span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="cart_right">
                    <div class="cart_total">
                        <h2>Total</h2>
                        <p>Subtotal <span id="cart-subtotal-price"></span> </p>
                        <p class="total_price">
                            Total (Tax Included) <span id="cart-total-price"></span> </p>
                        <button>
                            <a href="<?php echo e(url('/cart/address')); ?>">GO TO CHECKOUT</a>
                        </button>
                        <span id="cart-empty-err-msg" style="color: red;display:none"> No Item In cart </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageLevelJS'); ?>

<script>
    function calculatePrice() {
        var price = 0;
        var cart_item_length = 0;
        $('[id^="cart-item-price-"]').each(function(index, item) {
            price += parseFloat($(item).attr('val'));
            ++cart_item_length;
        });

        $("#cart-total-item-count").html(cart_item_length);
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

    $(document).ready(function() {
        calculatePrice();

    });


    function removeItemFrommCart(cartId) {
        $.ajax({
            method: 'POST',
            url: '<?php echo e(url('ajax/cart/')); ?>/' + cartId + '/delete',
            data: {
                cartId: cartId,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(data) {
                $("#cart-item-block-" + cartId).remove();
                calculatePrice();
                window.location.reload();
            }
        });
    }

    function changeCheckoutButtonStatus() {
        if ($('[id^="cart-item-price-"]').length == 0) {
            $("#cart-empty-err-msg").show();
            return false;
        }

        return true;
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>