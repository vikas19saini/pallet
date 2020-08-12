<?php $__env->startSection('content'); ?>

<?php if(session('status')): ?>
<div class="alert alert-success" role="alert">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('password.email')); ?>" aria-label="<?php echo e(__('Reset Password')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="email" type="email" placeholder="" class="floating-input<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>
                    <span class="highlight"></span>
                    <label>Email address</label>
                </div>
            </div>
            <?php if($errors->has('email')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('email')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
        <div class="col-lg-12">
            <div class="inner_top_hd view_bttn">
                <div class="input-group login_btn bttn-ctr">
                    <button type="submit" class="btn btn-primary">
                        <?php echo e(__('Send Password Reset Link')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.homepage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>