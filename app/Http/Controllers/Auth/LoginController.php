<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Toastr;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm(Request $request){
        return view('auth/login');
    }

     public function authenticate(Request $request)
    {
        $user = User::Where('email',$request->get('email'))->first();
        if($user) {
            $this->validate($request, [
                'email'    => 'required',
                'password' => 'required',
            ]);
            $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL ) 
                ? 'email' 
                : 'username';
         
            $request->merge([
                $login_type => $request->input('email')
            ]);

            if (Auth::attempt($request->only($login_type, 'password'))) {
                Toastr::success('You are successfully logged in!', 'Logged in', ["positionClass" => "toast-top-right"]);
               return redirect('/admin/dashboard');
            }
            Toastr::error('Please enter valid login details!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect('/admin/login');
        }else {
            Toastr::error('We did not found your account!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect('/admin/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        Toastr::success('Successfully logged out!', 'Logged out', ["positionClass" => "toast-top-right"]);
        return redirect('/admin/login');
    }

}
