<?php $__env->startSection('content'); ?>

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
                            <p><?php echo e($shipping['DeliveryDate']); ?> | <span> <?php echo e($shipping['ServiceType']); ?></span></p>
                        </div>

                        <?php $total_price = 0; ?>

                        <div class="delivery1">
                            <h2>Order</h2>
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $product = $item->product;
                            $total_price += $item->amount;
                            ?>
                            <div class="cart_first">
                                <div class="cart_img">
                                    <img src="<?php echo e(url( is_numeric($product->primary_image) ? ($product->image_primary ? $product->image_primary->location : '#') : 'img/product-images/'.$product->primary_image )); ?>" class="img-responsive"></div>
                                <div class="cart_content">
                                    <h3> <?php echo e($product->title); ?> <span>(<?php echo e($product->product_key); ?>)</span></h3>
                                    <p> <?php echo e($product->tagline); ?></p>
                                    <p>Quantity: <?php echo e($item->quantity); ?> pcs</p>
                                    <p id="cart-item-price-<?php echo e($item->id); ?>" val="<?php echo e($item->amount); ?>">Price: $<?php echo e($item->amount); ?></p>
                                    <p>Type: <?php echo e($item->order_type); ?></p>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $total_price += $shipping['DeliveryCharges'];?>
                        </div>

                    </div>
                    <?php $address = $cartItems[0]->address ?>

                    <div class="delivery_address_right">
                        <div class="delivery1">
                            <h2>Delivery address</h2>
                            <p><?php echo e($address->name); ?> <span> <?php echo e($address->address); ?>, <?php echo e($address->city); ?></span>
                                <span><?php echo e($address->country); ?>,  <?php echo e($address->zipcode); ?>  </span></p>
                        </div>
                        <div class="delivery1 delivery_total">
                            <h3>Sub total <span>$<?php echo e(number_format($total_price - $shipping['DeliveryCharges'], 2)); ?></span></h3>
                            <h3>Delivery <span id="delivery_charges">$<?php echo e($shipping['DeliveryCharges']); ?></span></h3>
                            <h3>Total <b>(VAT Included)</b> <span>$<?php echo e($total_price); ?> </span></h3>
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

        window.location.href = "<?php echo e(url('/')); ?>/checkout";
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>