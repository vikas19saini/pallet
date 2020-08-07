<?php $__env->startSection('content'); ?>

<section class="myaccount_section trems_section">
    <div class="container">
        <div class="row">
            <div class="myaccount_main">
                <div class="myaccount_left">
                    <ul>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
                        <li><a href="/shipping-and-returns">Shipping & Returns</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                        <li class="active"><a href="/faqs">FAQ's</a></li>
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
                    <div class="overview policy_tab tab-pane fade in active">
                        <h2>FAQ</h2>
                        <ol>
                            <li> 
                                What is the minimum order quantity I can buy from Platte store? 
                                <br />
                                We have an MOQ of 24 pieces per product.

                            </li> 

                            <li> 
                                Is customization of the fabric possible?
                                <br />
                                Yes, Customization is possible and is  subjective to extra charges depending on the level of customization required.
                            </li> 

                            <li> 
                                Do you ship worldwide?

                                <br />
                                Yes. We ship worldwide.
                            </li> 



                            <li> 
                                How do I sign up and activate my login Id?

                                <br />
                                Register on Pallet store by submitting basic information to receive user ID & password in your email.
                            </li> 


                            <li> 
                                Do I get a copyright for any design  I choose?
                                <br />
                                Copyright is restricted to 9 months which can be further extended for extra charges. After 9 months, the design will be made available on the store again.
                            </li> 


                            <li>
                                Can I provide my own fabric for production? 
                                <br />
                                No, you cannot supply your own fabric
                            </li>

                            <li>
                                Is the price of product all inclusive of fabric, design? 
                                <br />

                                Yes, the product prices are inclusive of fabric and design. There are no extra charges except shipping and taxes wherever applicable. 

                            </li>

                            <li>
                                If I order a sample of any product, how many pieces will be supplied?
                                <br />

                                A set of 3 pieces will be delivered per sample.

                            </li>


                            <li>
                                9. Are returns acceptable? 
                                <br />

                                All products available on Pallet store are non refundable. We want our customers to have a satisfying experience therefore our production process ensures you are happy with the final product. 
                            </li>


                            <li>
                                10. Do you offer Bulk discounts? 
                                <br />

                                Yes, we do offer bulk discounts. Our Backend algorithm allows you to increase your quantity, on the basis of which you can see prices in real time for any product you order. 
                            </li>


                            <li>
                                11. Can I cancel or change my Order?
                                <br />

                                You can request us to cancel/change your order within 24 hours of placing it. Once the order has been shipped it cannot be cancelled.  
                            </li>


                            <li>
                                12. What type of Payment do you accept?
                                <br />

                                We process Paypal and credit card payments. 
                            </li>




                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>