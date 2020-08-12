<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(route('register')); ?>" aria-label="<?php echo e(__('Register')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="name" type="text" class="floating-input<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                    <span class="highlight"></span>
                    <label>Name</label>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
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
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="mobile" type="phone" placeholder="" class="floating-input<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>" name="mobile" required>
                    <span class="highlight"></span>
                    <label>Contact number</label>
                </div>
            </div>
            <?php if($errors->has('mobile')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('mobile')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="company_name" type="text" placeholder="" class="floating-input<?php echo e($errors->has('company_name') ? ' is-invalid' : ''); ?>" name="company_name" required>
                    <span class="highlight"></span>
                    <label>Company name</label>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="password" type="password" placeholder="" class="floating-input<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>
                    <span class="highlight"></span>
                    <label>Password</label>
                </div>
            </div>
            <?php if($errors->has('password')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="password-confirm" type="password" placeholder="" class="floating-input" name="password_confirmation" required>
                    <span class="highlight"></span>
                    <label>Confirm Password</label>
                </div>
            </div>
        </div>
        <input type="hidden" placeholder="" class="floating-input" name="company_details" value="">
        <div class="col-lg-12">
            <div class="inner_top_hd view_bttn">
                <div class="input-group login_btn bttn-ctr">
                    <button type="submit"><?php echo e(__('Register')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="forget_pass"><a href="/" id="cancel_signup">Already a Member ? Login</a></div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.homepage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>