<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    use AuthenticatesUsers {
        login as protected AuthenticatesUsers_login;
        sendFailedLoginResponse as protected AuthenticatesUsers_sendFailedLoginResponse;
        sendLoginResponse as protected AuthenticatesUsers_sendLoginResponse;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
        return "name";
    }

    protected function sendLoginResponse(Request $request)
    {
        //return $this->AuthenticatesUsers_sendloginResponse($request);
        return redirect(route('backend'));
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return $this->AuthenticatesUsers_sendFailedLoginResponse($request);
    }

    public function login(Request $request)
    {
        return $this->AuthenticatesUsers_login($request);
    }




}
