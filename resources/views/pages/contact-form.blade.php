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


                        <div class="overview tab-pane in active" id="myaccount5">
                            <h2>Change contact details</h2>
                            <div class="contact_myaccount">
                                <div class="contact_first">
                                    <h2>Personal Information</h2>
                                    <form method="POST">
                                        <input type="hidden" name="type" value="contact_form">

                                        {{ csrf_field() }}

                                        <div class="form-group radio_icon">
                                            <label>Mrs. / Ms.
                                                <input type="radio" checked="checked" name="gender" value="male">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label>Mr.<input type="radio" name="gender" value="female">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Full Name*</label>
                                            <input type="text" name="name" value="{{ Auth::user()->email  ?? 'USER EMAIL'}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number*</label><input type="text" name="mobile" placeholder="Enter mobile no" value="{{ Auth::user()->mobile  ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Alternative Number</label><input type="text" name="alternate_mobile" placeholder="enter alternative mobile" value="{{ Auth::user()->alternate_mobile  ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <span>* mandatory field</span></div><div class="form-group">
                                            <button>SAVE</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
  

@endsection

