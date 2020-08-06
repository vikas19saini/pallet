@extends('layouts.app')


@section('pageLevelCSS')
    <style>
        .submit-address {
            /*display: none;*/
        }
    </style>
@endsection

@section('content')

    <section class="address_section">
        <div class="container">
            <div class="row">
                <div class="address_main">
                    <ul>
                        <li><span>1</span><b>Login</b></li>
                        <li class="right_icon"><span>2</span><b>Address</b></li>
                        <li><span>3</span><b>Confirm</b></li>
                        <li><span>4</span><b>Payment</b></li>
                        <li><span>5</span><b>Done!</b></li>
                    </ul>
                    <div class="address_home">
                        <ul>
                            <li class="active">
                                <a data-toggle="tab" href="#address_home1" aria-expanded="true">
                                    <i class="fa fa-home"></i> Pick From List</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#address_home2" aria-expanded="false">
                                    <i  class="fa fa-home"></i> Type A new Address</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">

                        <div class="address_home_main active" id="address_home1">
                        @foreach($addressList as $k=>$address)
                            <div class="address_myaccount address_home1"><p>
                                    {{ $address->name }}
                                    <span> {{ $address->address }}</span>
                                    <span>{{ $address->city }}, {{ $address->country }}</span></p>
                                <div class="adress_btn">
                                    <p class="checkbox_edit">
                                        <label for="checkbox_id">
                                            Make this address my default address
                                        </label>
                                        <input id="checkbox_id" type="checkbox">
                                        <span class="checkmark"></span>
                                    </p>
                                    <span>
                                        <button onclick="changeAddress({{$address->id}})">SELECT</button>
                                    </span>
                                    <span>
                                        <button id="submit-add-{{$address->id}}" class="submit-address" onclick="submitAddressForm()">Submit</button>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                        </div>



                        <div class="address_home_main" id="address_home2">
                            <div class="contact_first">
                                <form method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group radio_icon">
                                        <label>Mrs. / Ms.<input type="radio"   checked="checked" value="male"
                                                                                               name="gender">
                                            <span class="checkmark"></span></label>
                                        <label>Mr.<input type="radio"  name="gender" value="female"><span
                                                    class="checkmark"></span></label></div>
                                    <div class="form-group"><label>Full Name*</label><input type="text" name="name">
                                    </div>
                                    <div class="form-group"><label>Full Address</label><input type="text"
                                                                                              name="address"></div>
                                    <div class="form-group form-group2"><label>City</label><input type="text"
                                                                                                  name="city"></div>
                                    <div class="form-group form-group2"><label>Zip Code</label><input type="text"
                                                                                                      name="zipcode">
                                    </div>
                                    <div class="form-group form-group2"><label>Country</label><input type="text"
                                                                                                     name="country">
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

                    {{--<div class="delivery_address active">--}}
                        {{--<div class="delivery_address_left">--}}
                            {{--<div class="delivery1"><h2>Delivery Address<i class="fa fa-edit"></i></h2>--}}
                                {{--<p>Rakesh Mallick<span>Sovereign House, Hurworth Moor, Darlington</span><span>United Kingdom, DL2 1QH</span>--}}
                                {{--</p></div>--}}
                            {{--<div class="delivery1"><h2>Contact Details</h2>--}}
                                {{--<p>When your parcel is ready for collection, we will contact you via SMS, so please--}}
                                    {{--leave us your best contact number. Don’t forget to take your ID with you.</p>--}}
                                {{--<form>--}}
                                    {{--<div class="form-group"><label>Mobile Number (Optional)</label><input type="text"--}}
                                                                                                          {{--name=""></div>--}}
                                    {{--<div class="form-group"><label>Alternative Number (Optional)</label><input--}}
                                                {{--type="text" name=""></div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="delivery_address_right">--}}
                            {{--<div class="delivery1"><h2>Billing Address<i class="fa fa-edit"></i></h2><label>Rakesh--}}
                                    {{--Mallick<span>Sovereign House, Hurworth Moor, Darlington</span><span>United Kingdom, DL2 1QH</span><input--}}
                                            {{--id="billing_address" type="radio" name="radio"><span--}}
                                            {{--class="checkmark"></span></label>--}}
                                {{--<div class="add_new_address"><label>Add New Address<input id="add_Address" type="radio"--}}
                                                                                          {{--name="radio"><span--}}
                                                {{--class="checkmark"></span></label>--}}
                                    {{--<div class="contact_first">--}}
                                        {{--<form>--}}
                                            {{--<div class="form-group radio_icon"><label>Mrs. / Ms.<input type="radio"--}}
                                                                                                       {{--checked="checked"--}}
                                                                                                       {{--name="radio"><span--}}
                                                            {{--class="checkmark"></span></label><label>Mr.<input--}}
                                                            {{--type="radio" name="radio"><span--}}
                                                            {{--class="checkmark"></span></label></div>--}}
                                            {{--<div class="form-group"><label>Full Name*</label><input type="text" name="">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group"><label>Address Line</label><input type="text"--}}
                                                                                                      {{--name=""></div>--}}
                                            {{--<div class="form-group form-group2"><label>Town / City</label><input--}}
                                                        {{--type="text" name=""></div>--}}
                                            {{--<div class="form-group form-group2"><label>Postal Code</label><input--}}
                                                        {{--type="text" name=""></div>--}}
                                            {{--<div class="form-group">--}}
                                                {{--<button>NEXT</button>--}}
                                            {{--</div>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>


        <form method="post" name="submitAddress" id="submitAddress">
            <input type="hidden" name="address" id="form_address"/>
            <input type="hidden" name="type" value="proceed" />
            {{ csrf_field() }}
        </form>

    </section>

@endsection

@section('pageLevelJS')

    <script>


        $(document).ready(function () {
            $(".submit-address").css('display','none');
        });

        function changeAddress(addressId)
        {
            $(".submit-address").css('display','none');
            $("#submit-add-"+addressId).css('display','');
            $("#form_address").val(addressId);
        }

        function submitAddressForm()
        {
            $("#submitAddress").submit();
        }
    </script>

@endsection

