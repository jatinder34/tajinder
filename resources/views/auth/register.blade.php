@extends('layouts.app')

@section('content')
<div id="login">
   <form method="POST" action="{{ route('register') }}">
       <fieldset class="clearfix">
        @csrf
           <p><span class="fa fa-user"></span>
               <input type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required id="reg_username"  placeholder="name">
           </p>
           <!-- JS because of IE support; better: placeholder="Username" -->
           <p><span class="fa fa-envelope"></span>
               <input type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required id="reg_email"  placeholder="email">
           </p>
           <!-- JS because of IE support; better: placeholder="Password" -->
           <p><span class="fa fa-lock"></span>
               <input type="password" id="reg_password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password">
           </p>
           <!-- JS because of IE support; better: placeholder="Password" -->
           <p><span class="fa fa-lock"></span>
               <input type="password" class="" id="reg_password_confirm" name="password_confirmation" required placeholder="confirm password">
           </p>
           <!-- JS because of IE support; better: placeholder="Password" -->
           <div>
            @if (Route::has('password.request'))
            <span style="width:48%; text-align:left;  display: inline-block; "><a class="small-text" style="color: #848484;" href="{{url('/admin/login')}}">already have an account?</a></span>
            @endif
               <!-- <p>new user? <a href="{{ route('register') }}">create new account</a></p> -->
               <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Sign Up"></span>
           </div>
       </fieldset>
       <div class="clearfix"></div>
   </form>
   <div class="clearfix"></div>
</div>
<!-- end login -->
<div class="logo wow animated flip text-sky pt-5" data-wow-delay="0.2s">
    <img width="100" class="mt-5" src="{{URL::asset('/public/images/Logo.png')}}">
    <!-- <p>Click<span class="text-orange">Onik</span></p> -->
   <div class="clearfix"></div>
</div>


@endsection
