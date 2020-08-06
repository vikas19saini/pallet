@extends('layouts.homepage')

@section('content')

@if(\Illuminate\Support\Facades\Session::has('message'))
<div class="row">
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
</div>
@endif

<form method="post" action="{{ url('/login') }}" class="form-signin">
    <div class="input-group int_typ">
        <input type="email" placeholder="E-mail" name="email" required class="form-control">
    </div>
    <div class="input-group int_typ">
        <input type="password" placeholder="passsord" name="password" required class="form-control">
    </div>
    @if($errors->any())
    <p class="login_error">{{$errors->first()}}</p>
    @endif
    <div class="forget_pass"><a href="/password/reset">Forgot password?</a></div>
    <div class="input-group login_btn bttn-ctr">
        {{ csrf_field() }}
        <button type="submit">Login</button>
        <label class="new-here" id="btn-signup"><a href="/register">Sign up</a></label>
    </div>
</form>
@endsection
