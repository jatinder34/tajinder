@extends('layouts.app')

@section('content')
<!-- LOGIN FORM -->
<div class="text-center" style="padding:160px 0">
    <div class="logo">login</div>
    <!-- Main Form -->
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
    <div class="login-form-1">
        <form id="login-form" class="text-left" method="POST" action="{{ url('/admin/login') }}">
            @csrf
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="lg_username" class="sr-only">Username</label>
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="lg_username" name="email" placeholder="username" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lg_password" class="sr-only">Password</label>
                        <input type="password" id="lg_password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="password">
                    </div>
                    <div class="form-group login-group-checkbox">
                        <input type="checkbox" id="lg_remember" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="lg_remember">remember</label>
                    </div>
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="etc-login-form">
                @if (Route::has('password.request'))
                    <p>forgot your password?
                        <a href="{{ route('password.request') }}">
                            click here
                        </a>
                    </p>
                @endif
                <p>new user? <a href="{{ route('register') }}">create new account</a></p>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>

@endsection
