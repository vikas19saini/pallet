<header>
    <div class="container">
        <div class="row">
            <div class="header_main">
                <span class="menu_icon"><i class="mobile_menu"></i></span>
                <div class="logo">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('img/logo.png')); ?>" class="img-responsive logo1"/><img src="<?php echo e(url('img/logo2.png')); ?>" class="img-responsive logo2"/></a>
                </div>
                <div class="navigation">
                    <ul>
                        <li class="mobile-mc"><a href="/my-account">My Account</a></li>
                        <?php $count = 0?>
                        <?php $__currentLoopData = DB::table('product_categories')->limit(7)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($count < 3): ?>
                            <li><a href="<?php echo e(url('c/'.strtolower($item->slug))); ?>"> <?php echo e($item->name); ?> </a></li>
                            <?php $count++?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="profile_icon">
                    <ul>
                        <li><a href="<?php echo e(url('my-account')); ?>"><i class="fa fa-heart"></i></a></li>
                        <li><a href="<?php echo e(url('cart')); ?>"><i class="fa fa-cart-plus"></i></a></li>
                        <li><a href="<?php echo e(url('my-account')); ?>"><i class="fa fa-user"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>