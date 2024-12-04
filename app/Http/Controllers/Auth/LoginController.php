<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('auth')->only('logout');
    // }

    public function login(Request $request)
    {
        // Validate login form data
        $this->validateLogin($request);

        // Attempt to login with "remember" functionality
        if (Auth::attempt($this->credentials($request), $request->filled('remember'))) {
            // Set a persistent "remember_me" cookie for 30 days
            if ($request->filled('remember')) {
                Cookie::queue('remember_me', 'true', 60 * 24 * 30);
            } else {
                Cookie::queue(Cookie::forget('remember_me'));
            }

            // Redirect user to their intended location
            return $this->sendLoginResponse($request);
        }

        // If login fails, return failed login response
        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        // Invalidate session but keep 'remember_me' cookie if it exists
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Redirect to user login page
    }
}
