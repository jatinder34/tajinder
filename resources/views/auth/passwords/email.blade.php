@extends('layouts.app')

@section('content')
<!-- FORGOT PASSWORD FORM -->
<div class="text-center" style="padding:160px 0">
    <div class="logo">forgot password</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="forgot-password-form" class="text-left" method="POST" action="{{ url('/admin/forgotpassword') }}">
            @csrf
            <div class="etc-login-form">
                <p>When you fill in your registered email address, you will be sent instructions on how to reset your password.</p>
            </div>
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="login-group">
                    <div class="form-group">
                        <label for="fp_email" class="sr-only">Email address</label>
                        <input id="fp_email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="email address">
                    </div>
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="etc-login-form">
                <p>already have an account? <a href="{{url('/admin/login')}}">login here</a></p>
                <p>new user? <a href="{{url('/register')}}">create new account</a></p>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>


@endsection
