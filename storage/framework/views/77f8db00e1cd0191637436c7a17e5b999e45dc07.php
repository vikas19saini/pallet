<?php $__env->startSection('content'); ?>

    <section class="address_section">
        <div class="container">
            <div class="row" style="padding: 20px">
               
            <div class="" id="address_home2">
                            <div class="contact_first">
                                <form method="POST">
                                    <?php echo e(csrf_field()); ?>


                                    <div class="form-group radio_icon">
                                        <label>Mrs. / Ms.<input type="radio" value="male"
                                        <?php if($address->salution == "MALE"): ?> checked="checked"  <?php endif; ?> 
                                                                                               name="gender">
                                        <span class="checkmark"></span></label>
                                        <label>Mr.<input type="radio"  name="gender" value="female"
                                        <?php if($address->salution == "FEMALE"): ?> checked="checked"  <?php endif; ?> ><span
                                                    class="checkmark"></span></label></div>
                                    <div class="form-group">
                                        <label>Full Name*</label>
                                    <input type="text" name="name" value="<?php echo e($address->name); ?> ">
                                    </div>
                                    <div class="form-group"><label>Full Address</label>
                                    <input type="text" value="<?php echo e($address->address); ?> "
                                                                                              name="address"></div>
                                    <div class="form-group form-group2"><label>City</label>
                                    <input type="text" value="<?php echo e($address->city); ?> "
                                                                                                  name="city"></div>
                                    <div class="form-group form-group2">
                                    <label>Zip Code</label><input type="text" value="<?php echo e($address->zipcode); ?> "
                                                                                                      name="zipcode">
                                    </div>
                                    <div class="form-group " >
                                        <label> 
                                            Country
                                        </label>
                                        <!-- <input type="text" value="<?php echo e($address->country); ?> "  name="country"> -->
                                        <select required name="country" style="width: 100%" onchange="country_changed(this.value)"> 
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->country_id); ?>" <?php if($country->country_id == $address->country): ?> selected="selected" <?php endif; ?> > 
                                                    <?php echo e($country->name); ?> 
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                        </select>

                                    </div>
                                    <div class="form-group"  >
                                        <label>State</label>
                                        <!-- <input type="text" value="<?php echo e($address->state); ?> "  name="state"> -->
                                        <select required id="state_name" name="state" placeholder="Select State" style="width: 100%">
                                            <option disabled selected > Please select state </option>
                                        </select> 

                                    </div>
                                    <div class="form-group">
                                        <button>SAVE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
               


            </div>
        </div>

    </section>


<script>

    var country_list = []; 
    function country_changed(value) 
    {
        $.ajax({
            url: "<?php echo e(url('ajax/country/')); ?>" + '/'+value+'/state',
            method: 'POST',
            data: { _token: '<?php echo e(csrf_token()); ?>' },
            success: function(response) {
                country_list[value] = response.data; 
                var string = ''; 
                response.data.forEach(item => {
                    string += "<option value='" + item.zone_id + "'> " + item.name + "</option>"
                })
                $("#state_name").html(string); 
            }
        }); 
    }
</script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('pageLevelJS'); ?>
    <script>
        $(document).ready(function(){
            var selected_country = "<?php echo e($address->country); ?>"; 
            var selected_state = "<?php echo e($address->state); ?>"; 
            if( !isNaN(selected_country) ) 
            {
                country_changed(selected_country); 
                setTimeout(() => {
                    $("#state_name").val(selected_state); 
                    // console.log(selected_state); 
                }, 1500);
            } 
            


        });
    </script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>