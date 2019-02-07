@extends('layouts.app')

@section('content')

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
       <div id="login">
           <form method="POST" action="{{ url('/admin/login') }}">
               <fieldset class="clearfix">
                @csrf
                   <p><span class="fa fa-user"></span>
                       <input name="email" type="text" Placeholder="Username" required>
                   </p>
                   <!-- JS because of IE support; better: placeholder="Username" -->
                   <p><span class="fa fa-lock"></span>
                       <input name="password"  type="password" Placeholder="Password" required>
                   </p>
                   <!-- JS because of IE support; better: placeholder="Password" -->
                   <div>
                    @if (Route::has('password.request'))
                    <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="{{ route('password.request') }}"style="color: #848484;">Forgot
                       password?</a></span>
                    @endif
                       <!-- <p>new user? <a href="{{ route('register') }}">create new account</a></p> -->
                       <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Sign In"></span>
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
