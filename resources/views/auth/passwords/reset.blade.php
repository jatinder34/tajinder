@extends('layouts.app')

@section('content')
<!-- REGISTRATION FORM -->
<div class="text-center" style="padding:160px 0">
    <div class="logo">reset password</div>
        @if($errors->has('name') || $errors->has('email') || $errors->has('password'))
        <div class="row">
            <div class="col-md-12">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                 <br>
            </div>
        </div>
        @endif
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="register-form" class="text-left" method="POST" action="{{ url('/admin/reset-password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="reg_password" class="sr-only">New Password</label>
                        <input type="password" id="reg_password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="new_password" placeholder="new password" required="">
                    </div>
                    <div class="form-group">
                        <label for="reg_password_confirm" class="sr-only">Password Confirm</label>
                        <input type="password" class="form-control" id="reg_password_confirm" name="confirm_password" required placeholder="confirm password">
                    </div>
                    
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>

@endsection
