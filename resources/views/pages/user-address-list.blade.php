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
                   
                  
                    <div class="tab-content">

                        <div class="address_home_main active" id="address_home1">
                        @foreach($addressList as $k=>$address)
                            <div class="address_myaccount address_home1"><p>
                                    {{ $address->name }}
                                    <span> {{ $address->address }}</span>
                                    <span>{{ $address->city }}, {{ $address->country }}</span></p>
                                <div class="adress_btn">
                        
                                    <span>
                                        <button onclick="redirectAddressEdit({{$address->id}})"> Edit </button>
                                    </span>
                                    <span>
                                        <button id="submit-add-{{$address->id}}" onclick="return deleteAdress({{$address->id}})"> Delete </button>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                        </div>



                    </div>


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

        function redirectAddressEdit(id) {
            var url = "{{ url('/') }}"; 
            window.location.href = url + "/user/address/" + id;
        }

        function deleteAdress(id)
        {

            var  confirm = window.confirm("Are you sure you want to delete this address");
            if(confirm == false)
                return false; 

            $.ajax({
                url: '/ajax/user/address/'+id+'/delete',
                method : 'post',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if(response.status)
                        window.location.reload(); 
                }
            }); 
            return false; 
        }

    </script>

@endsection

