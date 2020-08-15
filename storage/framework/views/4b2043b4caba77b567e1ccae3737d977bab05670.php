<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Fabric  

                    <a href="<?php echo e(url('/admin/fabrics/add')); ?>" class="btn btn-primary"> Add </a> 

                    <!-- <i class="fa fa-align-justify"> </i> -->
                  </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th> id </th>
                            <th> Name </th>
                            <th> Code  </th>
                            <th> Active </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>  <?php echo e($item->id); ?> </td>
                                <td>  <?php echo e($item->name); ?> </td>
                                <td>  <?php echo e($item->code); ?> </td>
                               
                               <td>
                                    <?php if($item->active): ?>
                                    <span class="badge badge-success"> Active </span>
                                    <?php else: ?>
                                    <span class="badge badge-danger">Inactive</span>
                                    <?php endif; ?> 
                                </td>

                                <td>
                                    <a href="<?php echo e(url('admin/fabrics/'.$item->id)); ?>"> View </a>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>

                    <?php echo e($list->render()); ?>


                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>