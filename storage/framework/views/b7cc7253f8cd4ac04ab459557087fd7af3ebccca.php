<?php $__env->startSection('content'); ?>
<section class="myaccount_section">
        <div class="container">
            <div class="row">
                <h2>My Account</h2>
                <div class="myaccount_main">
                    
                    <?php echo $__env->make('includes.account-leftside-bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="myaccount_right tab-content">
                        <h2>Welcome <?php echo e(Auth::user()->name  ?? 'USER'); ?>,</h2>
                        <p>To your private corner of The Pallete store. You can manage your orders, returns, account info and convert sample order into order right here.</p>


                        <div class="overview tab-pane in active" id="myaccount5">
                            

                        <h2>My preferences</h2>
                            <p>Welcome to your preferences section of The Pallete store. You can convert your preferences into sample order right here.</p>
                            <div class="preferences">
                            
                                <?php $__currentLoopData = $preferences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php
                                    if ( $item->product->primary_image && !is_numeric($item->product->primary_image) )
                                        $image = $item->product->primary_image ? 'img/product-images/'.$item->product->primary_image : '#';  
                                    else
                                        $image = $item->product->image_primary ? $item->product->image_primary->location : '#';
                                ?>
                                    <div class="preferences1" >
                                        <img src="<?php echo e(url( $image )); ?>" class="img-responsive" onclick="return redirectToProduct('<?php echo e($item->product->slug); ?>')" />
                                        <p  onclick="return redirectToProduct('<?php echo e($item->product->slug); ?>')" >
                                            <span>
                                                <?php echo e($item->product->title); ?>

                                            
                                                <span>
                                                    <!-- <i>$ 30</i>    -->
                                                    $ <?php echo e($item->product->amount); ?> 
                                                </span>
                                            </span>
                                                <!-- <span><b></b><b></b><b></b><b></b></span> -->
                                            </p>
                                        <h3> <?php echo e($item->product->status); ?> </h3>
                                        <!-- <a href="javascript:void(0);">SHOW SIMILAR</a> -->
                                        <div onclick="return removeFromWishlist(<?php echo e($item->product_id); ?>)" class="close"></div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                                <?php if( count( $preferences ) == 0 ): ?>
                                    No Item In Wishlist 
                                <?php endif; ?> 
                            
                            </div>

                        </div>

                    </div>
                </div>
                <div class="subscribe_banner">
                    <!-- <a href="javascript:void(0);"><img src="img/subscribe_banner.jpg" class="img-responsive"/></a> -->
                </div>
            </div>
        </div>

     <?php echo e(csrf_field()); ?>

    </section>



<div class="filter1">
    <p>Filter</p>
</div>

<div class="mobile_filter">
    <div class="mobile_show_filter">
        <h3>Filter By</h3>
        <div class="accordion">
            <h4 class="accordion-toggle">Short By</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Material</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Price</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Colour</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile_filter_close">
        <a href="javascript:void(0);">CLOSE</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageLevelJS'); ?>
  
    <script>

        function redirectToProduct(str)
        {
            window.location.href = "<?php echo e(url('/')); ?>" + "/" + str + "/p"; 
        }

        function removeFromWishlist(id)
        {
            $.ajax({
                url: '<?php echo e(url("/ajax/product")); ?>/' +id+'/wishlist',
                method : 'post',
                data: { _token: '<?php echo e(csrf_token()); ?>' },
                success: function(response) { 
                    if(response.status)
                    {
                        window.location.reload(); 
                    } 
                }
            }); 
            return false;
        }

    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>