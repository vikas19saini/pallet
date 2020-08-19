<?php $__env->startSection('pageLevelCSS'); ?>
<link rel="stylesheet" href="<?php echo e(url('css_new/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="enquiry contact-form">
    <div class="container">
        <div class="row">
            <!-- <h2>CONTACT US</h2>-->
            <p>Need help? Have a question about an order, or about getting in touch? We're always happy to hear from you.</p>
            <ul>
                <li class="contact_form_btn active">For Enquiries</li>
                <li class="contact_details_btn">CONTACT DETAILS</li>
            </ul>
            <div class="enquiry_form active">
                <form method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="floating-form">
                                        <div class="popup_bx floating-label">
                                            <input class="floating-input" type="text" name="name" required="required">
                                            <span class="highlight"></span>
                                            <label>Your Name</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="floating-form">
                                        <div class="popup_bx floating-label">
                                            <input class="floating-input" type="email" name="email" required="required">
                                            <span class="highlight"></span>
                                            <label>Email address</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="floating-form">
                                        <div class="popup_bx floating-label">
                                            <input class="floating-input" type="text" name="phone">
                                            <span class="highlight"></span>
                                            <label>Contact number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group msg_enquiry">
                                        <div class="input textarea">
                                            <textarea name="details" placeholder="Details.." maxlength="500" id="message" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group custom_upp file_upload capcha_tab">
                                        <span>Upload Reference Pictures</span><label for="file-upload" class="custom-file-upload"> Upload Files </label>
                                        <div class="input file"><input type="file" name="image" id="file-upload"></div>
                                    </div>
                                    <div class="form-group btn_enquiry">
                                        <button type="submit">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group custom_add">
                                <h2>Need help contact us?</h2>
                                <div class="mainTx">
                                    <ul>
                                        <li>
                                            <i class="fa fa-whatsapp" target="_blank"></i>
                                            <h5>Call or WhatsApp us</h5>
                                        </li>
                                        <li><a target="_blank" href="https://api.whatsapp.com/send?phone=+919711073447">+919711073447</a></li>
                                        <li>
                                            <p>Mon - Sat | 10 AM to 7 PM (IST)</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mainTx">
                                    <ul>
                                        <li>
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <h5>Write to us</h5>
                                        </li>
                                        <li><a href="mailto:raghav@hpsingh.com">raghav@thepalettestore.com</a></li>
                                        <li>
                                            <p>We’ll get back to you within 24 hours</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <div class="contact_details">
            <div class="contact_details_area">
                <h2>Postal Address:</h2>
                <p>The palettestore Private Limited 111, 82-83 Vaikunth Building, Nehru Place, New Delhi -110019.</p>
                <div class="form-group custom_add">
                    <h2>Need help contact us?</h2>
                    <div class="mainTx">
                        <ul>
                            <li>
                                <i class="fa fa-whatsapp" target="_blank"></i>
                                <h5>Call or WhatsApp us</h5>
                            </li>
                            <li><a target="_blank" href="https://api.whatsapp.com/send?phone=+919711073447">+919711073447</a></li>
                            <li>
                                <p>Mon - Sat | 10 AM to 7 PM (IST)</p>
                            </li>
                        </ul>
                    </div>
                    <div class="mainTx">
                        <ul>
                            <li>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <h5>Write to us</h5>
                            </li>
                            <li><a href="mailto:raghav@hpsingh.com">raghav@thepalettestore.com</a></li>
                            <li>
                                <p>We’ll get back to you within 24 hours</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3504.726671685374!2d77.25175211455765!3d28.547934194656694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3c53d9b7de5%3A0xaabf796fb961c9b4!2sHP+Singh+Agencies+Private+Limited!5e0!3m2!1sen!2sin!4v1552202318943" frameborder="0" style="border:0" allowfullscreen=""></iframe></div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageLevelJS'); ?>
<script>
    $(document).ready(function() {
        $(".contact_form_btn").click(function() {
            $(this).addClass("active");
            $(".contact_details_btn").removeClass("active");
            $(".enquiry_form").addClass("active");
            $(".contact_details").removeClass("active");
        });
        $(".contact_details_btn").click(function() {
            $(this).addClass("active");
            $(".contact_form_btn").removeClass("active");
            $(".contact_details").addClass("active");
            $(".enquiry_form").removeClass("active");
        });
    });
</script>
<script>
    (function() {
        $('.toggle-wrap').on('click', function() {
            $(this).toggleClass('active');
            $('aside').animate({
                width: 'toggle'
            }, 200);
        });
    })();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>