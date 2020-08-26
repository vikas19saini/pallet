<?php $categories = DB::table('product_categories')->where(['status' => 'ACTIVE'])->get(); ?>
<header>
    <div class="container">
        <div class="row">
            <div class="header_main">
                <div class="mob_view menu_width">
                    <div class="" id="menu-button">
                        <div class="toggle-wrap">
                            <span class="toggle-bar"></span>
                        </div>
                    </div>
                    <nav id="hide-menu" class="hide-menu navigation">
                        <ul>
                            <li class="mobile-mc"><a href="<?php echo e(url('my-account')); ?>">My Account</a></li>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url($item->slug . '/c')); ?>"> <?php echo e($item->name); ?> </a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url('livebrowsing')); ?>">Live Browsing</a></li>
                            <li><a href="<?php echo e(url('contact')); ?>"> Enquire </a></li>
                            <li>
                                <a href="javascript:$('#logout').submit()"> Logout </a>
                                <form method="post" id="logout" action="<?php echo e(url('logout')); ?>" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="logo">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('img/logo.png')); ?>" class="img-responsive logo1" /><img src="<?php echo e(url('img/logo2.png')); ?>" class="img-responsive logo2" /></a>
                </div>
                <div class="navigation">
                    <ul>
                        <li class="mobile-mc"><a href="<?php echo e(url('my-account')); ?>">My Account</a></li>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(url($item->slug . '/c')); ?>"> <?php echo e($item->name); ?> </a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(url('livebrowsing')); ?>">Live Browsing</a></li>
                        <li><a href="<?php echo e(url('contact')); ?>"> Enquire </a></li>
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