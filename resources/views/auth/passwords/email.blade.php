@extends('layouts.homepage')

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" class="form-reset login_btn bttn-ctr">
    @csrf
    <input id="email" type="email" placeholder="Email address.." class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
    <button type="submit" class="btn btn-primary">
        {{ __('Send Password Reset Link') }}
    </button>
    <a href="/login">Login</a>
</form>

@endsection
