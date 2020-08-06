@extends('layouts.app')


@section('pageLevelCSS')

@endsection

@section('content')


    <section class="myaccount_section">
        <div class="container">
            <div class="row">

                <div class="col-sm-offset-2 contact_myaccount" >
                    <div class="contact_first" style="width: 70%">
                        <h2>Personal Information</h2>
                        <form method="POST">

                            <input type="hidden" name="type" value="contact_form">

                            {{ csrf_field() }}

                            <div class="form-group radio_icon">
                                <label>Mrs. / Ms.<input type="radio"   checked="checked" value="male"
                                                        name="gender">
                                    <span class="checkmark"></span></label>
                                <label>Mr.<input type="radio"  name="gender" value="female"><span
                                            class="checkmark"></span></label></div>


                            <div class="form-group">
                                <label>Full Name*</label>
                                <input type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label>Full Address</label>
                                <input type="text"  name="address">
                            </div>
                            <div class="form-group form-group2">
                                <label>City</label>
                                <input type="text" name="city">
                            </div>
                            <div class="form-group form-group2">
                                <label>Contact No</label>
                                <input type="text" name="contact_no">
                            </div>
                            <div class="form-group form-group2">
                                <label>Zip Code</label>
                                <input type="text" name="zipcode">
                            </div>

                            <div class="form-group form-group2">
                                <label>Country</label>
                                <input type="text" name="country" value="India" readonly>
                            </div>
                            <div class="form-group form-group2"><label>State</label><input type="text"
                                                                                           name="state"></div>
                            <div class="form-group">
                                <button>SAVE</button>
                            </div>

                        </form>
                    </div>
                </div>



                </div>
            </div>
        </div>
    </section>


@endsection