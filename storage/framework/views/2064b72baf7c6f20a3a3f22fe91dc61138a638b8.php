<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    List Users

                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Mobile </th>
                                <th> Company Name </th>
                                <th> Company Details </th>
                                <th> Alternative Mobile </th>
                                <th> Registered At </th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>  <?php echo e($user->id); ?> </td>
                                <td>  <?php echo e($user->name); ?> </td>
                                <td>  <?php echo e($user->email); ?> </td>
                                <td>  <?php echo e($user->mobile); ?> </td>
                                <td>  <?php echo e($user->company_name); ?> </td>
                                <td>  <?php echo e($user->company_details); ?> </td>
                                <td>  <?php echo e($user->alternative_mobile); ?> </td>

                                <td> <?php echo e($user->created_at); ?> </td>
                                
                                    
                                

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>


                    
                        
                            
                                
                            
                            
                                
                            
                            
                                
                            
                            
                                
                            
                            
                                
                            
                            
                                
                            
                        
                    



                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>