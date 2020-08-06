@extends('layouts.app')

@section('content')
<section class="myaccount_section">
        <div class="container">
            <div class="row">
                <h2>My Account</h2>
                <div class="myaccount_main">
                    
                    @include('includes.account-leftside-bar')

                    <div class="myaccount_right tab-content">
                        <h2>Welcome {{ Auth::user()->name  ?? 'USER'}},</h2>
                        <p>To your private corner of The Pallete store. You can manage your orders, returns, account info and convert sample order into order right here.</p>


                        <div class="overview tab-pane in active" id="myaccount6">
                            
                        <h2>My address book
                                <span>
                                    <a href="{{ url('user/address/new') }}">ADD NEW ADDRESS </a>
                                </span>
                            </h2>

                            <h3>Saved addresses</h3>
                            @foreach($addressList as $address)
                            <div class="address_myaccount address_myaccount2">
                                <p>
                                    {{ $address->name }}
                                    <span>{{ $address->address }}, {{$address->city}}, {{ $address->state }}</span>
                                    <span>{{ $address->country }}, {{ $address->country }}</span>
                                </p>
                                <div class="adress_btn">
                                    <!-- <p class="checkbox_edit"><label for="checkbox_id2">Make this address my default address</label> <input type="checkbox" id="checkbox_id2"><span class="checkmark"></span></p> -->
                                    <span>
                                        <button>
                                        <a href="{{ url('user/address/'.$address->id) }}">
                                            Edit 
                                        </a>
                                        </a> 
                                        </button>
                                    </span>
                                    <span><button onclick="return remove_address({{ $address->id }})">REMOVE</button></span>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>
                </div>
                <div class="subscribe_banner">
                    <!-- <a href="javascript:void(0);"><img src="img/subscribe_banner.jpg" class="img-responsive"/></a> -->
                </div>
            </div>
        </div>

     {{ csrf_field() }}
    </section>



<div class="filter1">
    <p>Filter</p>
</div>

<div class="mobile_filter">
    <div class="mobile_show_filter">
        <h3>Filter By</h3>
        <div class="accordion">
            <h4 class="accordion-toggle">Short By</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Material</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Price</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Colour</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile_filter_close">
        <a href="javascript:void(0);">CLOSE</a>
    </div>
</div>

@endsection

@section('pageLevelJS')

    <script>
        function remove_address(addressId)
        {
            $.ajax({
                method: 'POST',
                url: '{{ url('address/remove') }}',
                data: { address: addressId, _token: '{{ csrf_token() }}' },
                success: function(data) {
                    // console.log(data);
                    location.reload();
                }
            });
        }

    </script>

@endsection

