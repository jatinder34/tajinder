@extends('layouts.app')

@section('content')
<div id="login">
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
   <form method="POST" action="{{ url('/admin/reset-password') }}">
       <fieldset class="clearfix">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
           <p><span class="fa fa-user"></span>
               <input type="password" id="reg_password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="new_password" placeholder="new password" required="">
           </p>
           <!-- JS because of IE support; better: placeholder="Username" -->
           <p><span class="fa fa-lock"></span>
               <input type="password" class="" id="reg_password_confirm" name="confirm_password" required placeholder="confirm password">
           </p>
           <!-- JS because of IE support; better: placeholder="Password" -->
           <div>
               <!-- <p>new user? <a href="{{ route('register') }}">create new account</a></p> -->
               <span style="width:100%; text-align:right;  display: inline-block;"><input type="submit" value="Save"></span>
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
