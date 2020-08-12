@extends('layouts.homepage')

@section('content')

<form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <div class="row">
        <div class="col-lg-12">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="email" type="email" placeholder="" class="floating-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                    <span class="highlight"></span>
                    <label>Email address</label>
                </div>
            </div>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="password" placeholder="" type="password" class="floating-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <span class="highlight"></span>
                    <label>New password</label>
                </div>
            </div>
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-lg-6">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="password-confirm" placeholder="" type="password" class="floating-input" name="password_confirmation" required>
                    <span class="highlight"></span>
                    <label>Confirm password</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="inner_top_hd view_bttn">
            <div class="input-group login_btn bttn-ctr">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </div>
</form>

@endsection