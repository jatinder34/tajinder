<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Mail\ForgotPassword;
use App\User;
use Mail;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgotPassword(Request $request)
    {
       $input = $request->all();
       $input['token'] = str_random(32);
       $user  = User::where('email',$input['email'])->first();
        if($user){
           $user->reset_password = $input['token'];
           $user->save();
            Mail::to($input['email'])->send(new ForgotPassword($input));
            return redirect('/password/reset')->with('success','Please check your email');
       }else{
        return redirect('/password/reset')->with('error','We did not found your account!');
       }
    }

    public function resetPasswordForm($token)
    {
        return view('auth.passwords.reset',['token'=>$token]);
    }

    public function setPassword(Request $request)
    {
        $input = $request->all();
        if($input['new_password'] != $input['confirm_password']){
            return redirect('/admin/reset-password/'.$input['token'])->with('warning','Password miss match.');
        }else{
            $user  = User::where('reset_password',$input['token'])->first();
                if($user){
                    $user->password = bcrypt($input['new_password']);
                    $user->reset_password = null;
                    if($user->save()){
                        return redirect('/admin/login')->with('success','Password changed successfully.');
                    }
                }
        }
        echo "<pre>";
        print_r($input);
        exit;
    }
}
