@extends('layouts.homepage')


@section('content')

@if(\Illuminate\Support\Facades\Session::has('message'))
<div class="row">
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
</div>
@endif

<form method="post" action="{{ url('/login') }}" id="loginForm">
    <div class="row">
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input class="floating-input" name="email" type="email" required="required">
                    <span class="highlight"></span>
                    <label>Email Address</label>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input class="floating-input" name="password" type="password" required="required">
                    <span class="highlight"></span>
                    <label>Password</label>
                </div>
            </div>
            @if($errors->any())
            <span>{{$errors->first()}}</span>
            @endif
        </div>
        <div class="col-lg-12">
            <div class="inner_top_hd view_bttn">
                <button type="submit">Enter Website</button>
            </div>
        </div>
    </div>

    <div class="forget_pass">
        <a href="/password/reset" id="forgot_pswd">Forgot password?</a> | <a href="/register">Sign up</a>
    </div>
    {{ csrf_field() }}
</form>



@endsection