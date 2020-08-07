<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(route('register')); ?>" aria-label="<?php echo e(__('Register')); ?>" class="form-signup">
    <?php echo csrf_field(); ?>
    <div class="input-group int_typ">
        <input id="name" type="text" placeholder="Name" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
        <?php if($errors->has('name')): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('name')); ?></strong>
        </span>
        <?php endif; ?>
    </div>
    <div class="input-group int_typ">
        <input id="email" type="email" placeholder="Email address" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

        <?php if($errors->has('email')): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('email')); ?></strong>
        </span>
        <?php endif; ?>
    </div>
    <div class="input-group int_typ">
        <input id="mobile" type="phone" placeholder="Contact number" class="form-control<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>" name="mobile" required>

        <?php if($errors->has('mobile')): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('mobile')); ?></strong>
        </span>
        <?php endif; ?>
    </div>
    <div class="input-group int_typ">
        <input id="company_name" type="text" placeholder="Company name" class="form-control<?php echo e($errors->has('company_name') ? ' is-invalid' : ''); ?>" name="company_name" required>

        <?php if($errors->has('company_name')): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('company_name')); ?></strong>
        </span>
        <?php endif; ?>
    </div>
    <div class="input-group int_typ">
        <textarea id="company_details" placeholder="Company details" class="form-control<?php echo e($errors->has('company_details') ? ' is-invalid' : ''); ?>" name="company_details" required></textarea>

        <?php if($errors->has('company_details')): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('company_details')); ?></strong>
        </span>
        <?php endif; ?>
    </div>
    <div class="input-group int_typ">
        <input id="password" type="password" placeholder="Password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

        <?php if($errors->has('password')): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('password')); ?></strong>
        </span>
        <?php endif; ?>
    </div>
    <div class="input-group int_typ">
        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
    </div>
    <div class="input-group login_btn bttn-ctr">
        <button type="submit"><?php echo e(__('Register')); ?></button>
    </div>
    <div class="forget_pass"><label class="new-here"><a href="/" id="cancel_signup">Already a Member ? Login</a></label></div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.homepage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>