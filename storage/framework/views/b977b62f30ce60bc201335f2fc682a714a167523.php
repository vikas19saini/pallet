<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <link rel="shortcut icon" href="<?php echo e(url('img/favicon.png')); ?>" type=""/>

    <?php if( isset($meta) ): ?>
        <title> <?php echo e($meta['title']); ?> | Palette Store </title>
        <meta name="description" content="<?php echo e($meta['keywords']); ?>" />
        <meta name="keywords" content="<?php echo e($meta['description']); ?>" />
    <?php else: ?>
        <title> Palatte Store || Home</title>
    <?php endif; ?>


    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/aos.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/owl.carousel.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/header.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/footer.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/responsive.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/magiczoomplus.css')); ?>">
    <?php echo $__env->yieldContent('pageLevelCSS'); ?>

    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <style>
        .navigation ul li a {
            color: #655b5b;
        }
    </style>

</head>
<body class="main_header">

<!-- header area start -->
<?php echo $__env->make("includes.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- header area end -->

<?php if(\Illuminate\Support\Facades\Session::has('message')): ?>
<div class="row">
    <div class="alert alert-success">
        <?php echo e(Session::get('message')); ?>

    </div>
</div>
<?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>

<!-- footer area start -->
<?php echo $__env->make("includes.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- footer area end -->


<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo e(url('js/jquery-1.12.0.min.js')); ?>"><\/script>')
</script>
<script type="text/javascript" src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/aos.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/smoothScroll.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/owl.carousel.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/palatte_store.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/magiczoomplus.js')); ?>"></script>

<?php echo $__env->yieldContent('pageLevelJS'); ?>

</body>
</html>