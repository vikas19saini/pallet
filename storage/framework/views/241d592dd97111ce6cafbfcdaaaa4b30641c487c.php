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


                        <div class="overview tab-pane in active" id="myaccount6">
                            
                        <h2>My address book
                                <span>
                                    <a href="<?php echo e(url('user/address/new')); ?>">ADD NEW ADDRESS </a>
                                </span>
                            </h2>

                            <h3>Saved addresses</h3>
                            <?php $__currentLoopData = $addressList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="address_myaccount address_myaccount2">
                                <p>
                                    <?php echo e($address->name); ?>

                                    <span><?php echo e($address->address); ?>, <?php echo e($address->city); ?>, <?php echo e($address->state); ?></span>
                                    <span><?php echo e($address->country); ?>, <?php echo e($address->country); ?></span>
                                </p>
                                <div class="adress_btn">
                                    <!-- <p class="checkbox_edit"><label for="checkbox_id2">Make this address my default address</label> <input type="checkbox" id="checkbox_id2"><span class="checkmark"></span></p> -->
                                    <span>
                                        <button>
                                        <a href="<?php echo e(url('user/address/'.$address->id)); ?>">
                                            Edit 
                                        </a>
                                        </a> 
                                        </button>
                                    </span>
                                    <span><button onclick="return remove_address(<?php echo e($address->id); ?>)">REMOVE</button></span>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
        function remove_address(addressId)
        {
            $.ajax({
                method: 'POST',
                url: '<?php echo e(url('address/remove')); ?>',
                data: { address: addressId, _token: '<?php echo e(csrf_token()); ?>' },
                success: function(data) {
                    // console.log(data);
                    location.reload();
                }
            });
        }

    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>