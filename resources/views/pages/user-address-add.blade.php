@extends('layouts.app')

@section('content')

    <section class="address_section">
        <div class="container">
            <div class="row" style="padding: 20px">
               
            <div class="" id="address_home2">
                            <div class="contact_first">
                                <form method="POST" action="{{ url('user/address') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group radio_icon">
                                        <label>Mrs. / Ms.<input type="radio" value="male"
                                         checked="checked"  name="gender">
                                        <span class="checkmark"></span></label>
                                        <label>Mr.<input type="radio"  name="gender" value="female"><span
                                                    class="checkmark"></span></label></div>
                                    <div class="form-group">
                                        <label>Full Name*</label>
                                    <input type="text" name="name" required value="">
                                    </div>
                                    <div class="form-group"><label>Full Address</label>
                                    <input type="text" required name="address"></div>
                                    <div class="form-group form-group2"><label>City</label>
                                    <input type="text" required name="city"></div>
                                    <div class="form-group form-group2">
                                    <label>Zip Code</label><input type="text" required name="zipcode">
                                    </div>
                                    <div class="form-group " >
                                        <label> 
                                            Country
                                        </label>
                                        <select required name="country" style="width: 100%" onchange="country_changed(this.value)"> 
                                            <option disabled selected > Please select Country </option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->country_id }}"> 
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach 
                                        </select>

                                    </div>
                                    <div class="form-group"  >
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

    </section>


<script>

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


@section('pageLevelJS')
    <script>
        $(document).ready(function(){
            var selected_country = ""; 
            var selected_state = ""; 
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
@endsection 