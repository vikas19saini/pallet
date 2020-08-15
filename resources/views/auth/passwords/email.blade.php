@extends('layouts.homepage')

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="floating-form">
                <div class="floating-label">
                    <input id="email" type="email" placeholder="" class="floating-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
        <div class="col-lg-12">
            <div class="inner_top_hd view_bttn">
                <button type="submit">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>
    </div>
</form>

@endsection