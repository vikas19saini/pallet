<div class="myaccount_left">
                        <ul>
                            <li class="active1">
                                <a href="<?php echo e(url('/user/order')); ?>">My Overview</a>
                            </li>
                            <li><a  href="<?php echo e(url('/user/order/sample')); ?>">Sample Orders</a></li>
                            <li><a  href="<?php echo e(url('/user/order/production')); ?>">Production Orders</a></li>
                            <li><a  href="<?php echo e(url('/user/contact-form')); ?>">My Contact Data</a></li>
                            <li><a  href="<?php echo e(url('/user/address')); ?>">My Address Book</a></li>
                            <li class="click_tab"><a href="<?php echo e(url('user/preferences')); ?>">My Preferences</a></li>
                            <li>
                                <form method="post" action="<?php echo e(url('logout')); ?>">
                                    <?php echo e(csrf_field()); ?> 
                                    <input style="border: none;background: none;" type="submit" value="Logout" />
                                </form>
                            </li>
                        </ul>
                        <div class="select_mobile_section">
                            <select class="mob_select" id="show">
                                <option value="<?php echo e(url('/user/order')); ?>">My Overview</option>
                                <option value="<?php echo e(url('/user/order/sample')); ?>">Sample Orders </option>
                                <option value="<?php echo e(url('/user/order/production')); ?>">Production Orders</option>
                                <option value="<?php echo e(url('/user/contact-form')); ?>">My Contact Data</option>
                                <option value="<?php echo e(url('/user/address')); ?>">My Address Book</option>
                                <option value="<?php echo e(url('user/preferences')); ?>">My Preferences</option>
                            </select>
                        </div>
                    </div>
<script>
    document.getElementById('show').addEventListener('change', function (){
        window.location.href = this.value;
    });
</script>