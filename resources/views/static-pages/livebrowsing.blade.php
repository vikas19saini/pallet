@extends('layouts.app')

@section('pageLevelCSS')
<link rel="stylesheet" href="{{ url('css_new/style.css') }}">
@endsection

@section('content')

<div class="mobile_hidden_vissible">

    <section class="enquiry contact-form sub_TX">
        <div class="container">
            <div class="row">
                <h2><strong>Browse Our Store</strong></h2>
                <p>Register with us now and get your bookings done for the next live store browsing session ,<span> as we walk you through your favourite sections virtually.</span></p>
                <div class="enquiry_form live custom_form">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
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
                                        <input class="floating-input" type="text" name="phone" required="required">
                                        <span class="highlight"></span>
                                        <label>Contact number</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group check_cus custom_add">
                                    <h2>Preffered Browsing Tool :</h2>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="Whatsapp" name="tool[]"><span>Whatsapp Video Call</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="Facetime" name="tool[]"><span>Facetime</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="Google Duo" name="tool[]"><span>Google Duo</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="Skype" name="tool[]"><span>Skype</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="Google Hangout" name="tool[]"><span>Google Hangout</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group custom_add mrg_top">
                                    <p>Preffered date :</p>
                                    <input type="date" id="inner_wd" name="date">
                                </div>
                                <div class="form-group custom_add mrg_top">
                                    <p>Terms and conditions :</p>
                                    <p><input type="checkbox" required="required" style="width: auto;"> We hereby agree to get on a video call with thepalettestore team members</p>
                                </div>
                                <div class="form-group file_upload mrg_top capcha_tab">
                                    <span>Upload Reference Pictures</span>
                                    <label for="file-upload" class="custom-file-upload">
                                        Upload Files
                                    </label>
                                    <div class="input file">
                                        <input type="file" name="image" id="file-upload"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group btn_enquiry">
                            <button type="submit">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection