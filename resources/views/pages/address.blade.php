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
                        <li><span>1</span><b>Cart</b></li>
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
                                        <label>Mrs. / Ms.
                                            <input type="radio" checked="checked" value="MALE" name="salution">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label>Mr.<input type="radio" name="salution" value="FEMALE">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Full name">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="address" placeholder="Complete address"></textarea>
                                    </div>
                                    <div class="form-group form-group2">                                        
                                        <input type="text" name="city" placeholder="City">
                                    </div>
                                    <div class="form-group form-group2">
                                        <input type="text" name="zipcode" placeholder="Postcode">
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select name="country" style="width: 100%" required onchange="country_changed(this.value)"> 
                                            @foreach($countries as $country)
                                            <option value="{{ $country->country_id }}"> {{ $country->name }} </option> 
                                            @endforeach 
                                        </select> 
                                    </div>
                                    <div class="form-group" style="width: 100%" required>
                                        <label>State</label>
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
            </div>
        </div>


        <form method="post" name="submitAddress" id="submitAddress" action="{{ url('cart/select_address') }}">
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

    var country_list = []; 
    function country_changed(value) 
    {
        $.ajax({
            url: "{{ url('ajax/country/') }}" + '/'+value+'/state',
            method: 'POST',
            data: { _token: '{{ csrf_token() }}' },
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

@endsection

