@extends('layouts.app')

@section('content')

<!-- REGISTRATION FORM -->
<div class="text-center" style="padding:160px 0">
    <div class="logo">register</div>
        @if($errors->has('name') || $errors->has('email') || $errors->has('password'))
        <div class="row">
            <div class="col-md-12">
                @if ($errors->has('name'))
                    <span class="invalid-feedback alert alert-danger" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <br>
                 @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif 
                <br>
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
        <form id="register-form" class="text-left" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="reg_username" class="sr-only">Name</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required id="reg_username"  placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="reg_email" class="sr-only">Email</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required id="reg_email"  placeholder="email">
                    </div>
                    <div class="form-group">
                        <label for="reg_password" class="sr-only">Password</label>
                        <input type="password" id="reg_password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="reg_password_confirm" class="sr-only">Password Confirm</label>
                        <input type="password" class="form-control" id="reg_password_confirm" name="password_confirmation" required placeholder="confirm password">
                    </div>
                    
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="etc-login-form">
                <p>already have an account? <a href="{{url('/admin/login')}}">login here</a></p>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>

@endsection
