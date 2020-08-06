@extends('layouts.homepage')

@section('content')

<form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}" class="form-reset login_btn bttn-ctr">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="input-group int_typ">
        <input id="email" type="email" placeholder="Email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-group int_typ">
        <input id="password" placeholder="New password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
    <div class="input-group int_typ">
        <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required>
    </div>
    <div class="input-group login_btn bttn-ctr">
        <button type="submit" class="btn btn-primary">
            {{ __('Reset Password') }}
        </button>
    </div>
</form>

@endsection
