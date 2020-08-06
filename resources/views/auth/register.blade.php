@extends('layouts.homepage')

@section('content')

<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" class="form-signup">
    @csrf
    <div class="input-group int_typ">
        <input id="name" type="text" placeholder="Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-group int_typ">
        <input id="email" type="email" placeholder="Email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-group int_typ">
        <input id="mobile" type="phone" placeholder="Contact number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" required>

        @if ($errors->has('mobile'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('mobile') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-group int_typ">
        <input id="company_name" type="text" placeholder="Company name" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" required>

        @if ($errors->has('company_name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('company_name') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-group int_typ">
        <textarea id="company_details" placeholder="Company details" class="form-control{{ $errors->has('company_details') ? ' is-invalid' : '' }}" name="company_details" required></textarea>

        @if ($errors->has('company_details'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('company_details') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-group int_typ">
        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-group int_typ">
        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
    </div>
    <div class="input-group login_btn bttn-ctr">
        <button type="submit">{{ __('Register') }}</button>
    </div>
    <div class="forget_pass"><label class="new-here"><a href="/" id="cancel_signup">Already a Member ? Login</a></label></div>
</form>
@endsection
