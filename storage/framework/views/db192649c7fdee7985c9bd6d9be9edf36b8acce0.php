<?php $__env->startSection('content'); ?>

<?php if(session('status')): ?>
<div class="alert alert-success" role="alert">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('password.email')); ?>" aria-label="<?php echo e(__('Reset Password')); ?>" class="form-reset login_btn bttn-ctr">
    <?php echo csrf_field(); ?>
    <input id="email" type="email" placeholder="Email address.." class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>
    <?php if($errors->has('email')): ?>
    <span class="invalid-feedback" role="alert">
        <strong><?php echo e($errors->first('email')); ?></strong>
    </span>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary">
        <?php echo e(__('Send Password Reset Link')); ?>

    </button>
    <a href="/login">Login</a>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.homepage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>