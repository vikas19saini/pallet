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
                            <li class="mobile-mc"><a href="<?php echo e(url($item->slug . '/c')); ?>"> <?php echo e($item->name); ?> </a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- <li>
                                <div class="accordion acco_b_remove acco_head">
                                    <h4 class="accordion-toggle">Scarves</h4>
                                    <div class="accordion-content footer_menu1">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p><a href="<?php echo e(url($item->slug . '/c')); ?>"> <?php echo e($item->name); ?> </a></p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </li> -->

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
                    <ul class="nav navbar-nav navm">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(url($item->slug . '/c')); ?>"> <?php echo e($item->name); ?> </a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <li><a href="<?php echo e(url('livebrowsing')); ?>">Live Browsing</a></li>
                        <li><a href="<?php echo e(url('contact')); ?>"> Enquire </a></li>
                    </ul>
                </div>
                <div class="profile_icon">
                    <ul>
                        <li><a href="<?php echo e(url('user/preferences')); ?>"><i class="fa fa-heart"></i></a>
                            <div class="badge" id="cartItems">
                                <?php echo e(DB::table('wishlist')->where('user_id', Auth::user()->id)->get()->count()); ?>

                            </div>
                        </li>
                        <li><a href="<?php echo e(url('cart')); ?>"><i class="fa fa-cart-plus"></i></a>
                            <div class="badge" id="cartItems">
                                <?php echo e(DB::table('cart')->where('user_id', Auth::user()->id)->get()->count()); ?>

                            </div>
                        </li>
                        <li><a href="<?php echo e(url('my-account')); ?>"><i class="fa fa-user"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>