<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    protected $phone='phone';
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
    public function username()
    {
        return 'phone';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/customer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }
    protected function guard()
    {
        return auth()->guard('applicant');
    }
    public function showLoginForm()
    {
        return view('customer-auth.login');
    }


}
