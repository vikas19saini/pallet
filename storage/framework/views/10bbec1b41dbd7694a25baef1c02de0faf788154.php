<?php $__env->startSection('content'); ?>

<?php if(\Illuminate\Support\Facades\Session::has('message')): ?>
<div class="row">
    <div class="alert alert-success">
        <?php echo e(Session::get('message')); ?>

    </div>
</div>
<?php endif; ?>

<form method="post" action="<?php echo e(url('/login')); ?>" id="loginForm">
    <div class="row">
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input class="floating-input" name="email" type="email" required="required">
                    <span class="highlight"></span>
                    <label>Email Address</label>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input class="floating-input" name="password" type="password" required="required">
                    <span class="highlight"></span>
                    <label>Password</label>
                </div>
            </div>
            <?php if($errors->any()): ?>
            <span><?php echo e($errors->first()); ?></span>
            <?php endif; ?>
        </div>
        <div class="col-lg-12">
            <div class="inner_top_hd view_bttn">
                <p><a href="javascript:void()" onclick="$('#loginForm').submit()">Enter Website</a></p>
            </div>
        </div>
    </div>

    <div class="forget_pass">
        <a href="/password/reset" id="forgot_pswd">Forgot password?</a> | <a href="/register">Sign up</a>
    </div>
    <?php echo e(csrf_field()); ?>

</form>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.homepage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>