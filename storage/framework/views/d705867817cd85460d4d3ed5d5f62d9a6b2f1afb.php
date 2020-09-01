<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    <a class="btn btn-primary" href="<?php echo e(url('admin/products/add')); ?>"> Add  </a>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th> id </th>
                                <th> Title </th>
                                <th> Tagline </th>
                                <th> Amount </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>  <?php echo e($product->id); ?> </td>
                                <td>  <?php echo e($product->title); ?> </td>
                                <td>  <?php echo e($product->tagline); ?> </td>
                                <td>  <?php echo e($product->amount); ?> </td>
                                 <td>

                                    <span class="badge badge-success"> <?php echo e($product->status); ?></span>
                                    
                                    
                                    
                                    
                                </td>

                                <td>
                                    <a href="<?php echo e(url('admin/products/'.$product->id)); ?>"> Edit </a>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>


                    <?php echo e($products->render()); ?>


                    
                        
                            
                                
                            
                            
                                
                            
                            
                                
                            
                            
                                
                            
                            
                                
                            
                            
                                
                            
                        
                    



                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>