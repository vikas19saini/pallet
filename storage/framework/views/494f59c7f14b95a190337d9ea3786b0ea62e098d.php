<?php $__env->startSection('content'); ?>

<section class="myaccount_section trems_section">
    <div class="container">
        <div class="row">
            <div class="myaccount_main">
                <div class="myaccount_left">
                    <ul>
                        <li><a href="/about-us">About Us</a></li>
                        <li class="active"><a href="/terms-and-conditions">Terms & Conditions</a></li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
                        <li><a href="/shipping-and-returns">Shipping & Returns</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                        <li><a href="/faqs">FAQ's</a></li>
                    </ul>
                    <div class="select_mobile_section">
                        <select class="mob_select" onchange="window.location.href = this.value">
                            <option value="<?php echo e(url('/about-us')); ?>">About Us</option>
                            <option value="<?php echo e(url('/terms-and-conditions')); ?>">Terms & Conditions</option>
                            <option value="<?php echo e(url('/privacy-policy')); ?>">Privacy Policy </option>
                            <option value="<?php echo e(url('/shipping-and-returns')); ?>">Shipping & Returns</option>
                            <option value="<?php echo e(url('/cookie-policy')); ?>">Cookie Policy</option>
                            <option value="<?php echo e(url('/faqs')); ?>">FAQ's</option>
                        </select>
                    </div>
                </div>
                <div class="myaccount_right tab-content">
                    <div class="overview policy_tab tab-pane fade in active" id="myaccount1">
                        <h2>Terms & Conditions</h2>
                        <p>By using our website, you hereby consent to our Privacy Policy and agree to its Terms and Conditions.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?> 

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>