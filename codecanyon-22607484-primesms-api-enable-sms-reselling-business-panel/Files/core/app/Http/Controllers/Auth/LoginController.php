<?php

namespace App\Http\Controllers\Auth;

use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = 'user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $general = GeneralSetting::first();
        if($general->recaptcha == 1) {
            $verifyResponse = @file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $general->secret_key . '&response=' . $request->post('g-recaptcha-response'));
            $resp = json_decode($verifyResponse, true);
            if ($resp['success'] == false) {
                session()->flash('error', 'Please validate recaptcha');
                return back();
            }
        }
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        if(Auth::user()->two_step_verify == 1 && Auth::user()->two_step_verification == 1){
            $user = User::findOrFail(Auth::id());
            $user->two_step_verification = 0;
            $user->save();
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('home');
    }
}
