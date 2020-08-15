
<form method="POST" enctype="multipart/form-data">

    <input type="file" name="excel" />

    <input type="submit" /> 


    <?php echo e(csrf_field()); ?> 

</form> 