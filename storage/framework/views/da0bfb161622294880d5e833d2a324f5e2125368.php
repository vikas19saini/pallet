<?php $__env->startSection('content'); ?>

<section class="myaccount_section trems_section">
    <div class="container">
        <div class="row">
            <div class="myaccount_main">
                <div class="myaccount_left">
                    <ul>
                        <li class="active"><a href="/about-us">About Us</a></li>
                        <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
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
                        <h2>About Us</h2>
                        <p>The Pallet store is a company that aims to create fabrics from sustainable and organic materials to develop products like scarfs, kaftans and Parios. We offer a great assortment of products so that you can choose what’s right for you.  Integrating a deep understanding of the creative execution and production process enables us to shorten the time and keep the costs low. 

                            Our MOQ is 24 pieces in any color & design you require. Pallet store is sister concern of H.P Singh, one of the largest fabric suppliers from South East Asia for over a period of 40 years. We use ecologically sustainable fabrics made out of recycled plastic bottles, GOTS certified organic cotton, sustainable modals and silks. We believe in providing customers with the highest level of quality and service.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>