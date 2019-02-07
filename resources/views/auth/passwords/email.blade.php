@extends('layouts.app')

@section('content')
<div id="login">
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
   <form method="POST" action="{{ url('/admin/forgotpassword') }}">
       <fieldset class="clearfix">
        @csrf
           <!-- JS because of IE support; better: placeholder="Username" -->
           <p><span class="fa fa-envelope"></span>
               <input id="fp_email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="email address">
           </p>
          
           <!-- JS because of IE support; better: placeholder="Password" -->
           <div>
            @if (Route::has('password.request'))
            <span style="width:48%; text-align:left;  display: inline-block; "><a class="small-text" style="color: #848484;" href="{{url('/admin/login')}}">already have an account? </a></span>
            @endif
               <!-- <p>new user? <a href="{{ route('register') }}">create new account</a></p> -->
               <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Send"></span>
           </div>
       </fieldset>
       <div class="clearfix"></div>
   </form>
   <div class="clearfix"></div>
</div>
<!-- end login -->
<div class="logo wow animated flip text-sky" data-wow-delay="0.2s">
    <img width="80" src="{{URL::asset('/public/images/Logo.png')}}">
    <!-- <p>Click<span class="text-orange">Onik</span></p> -->
   <div class="clearfix"></div>
</div>

@endsection
