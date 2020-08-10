<?php $__env->startSection('content'); ?>

<?php if(\Illuminate\Support\Facades\Session::has('message')): ?>
<div class="row">
    <div class="alert alert-success">
        <?php echo e(Session::get('message')); ?>

    </div>
</div>
<?php endif; ?>

<form method="post" action="<?php echo e(url('/login')); ?>" class="form-signin">
    <div class="input-group int_typ">
        <input type="email" placeholder="E-mail" name="email" required class="form-control">
    </div>
    <div class="input-group int_typ">
        <input type="password" placeholder="passsord" name="password" required class="form-control">
    </div>
    <?php if($errors->any()): ?>
    <p class="login_error"><?php echo e($errors->first()); ?></p>
    <?php endif; ?>
    <div class="forget_pass"><a href="/password/reset">Forgot password?</a></div>
    <div class="input-group login_btn bttn-ctr">
        <?php echo e(csrf_field()); ?>

        <button type="submit">Login</button>
        <label class="new-here" id="btn-signup"><a href="/register">Sign up</a></label>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.homepage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>