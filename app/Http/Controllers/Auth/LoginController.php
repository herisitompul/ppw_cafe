<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
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

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {
        if ($request->has('remember')) {
            Cookie::queue('remember_token', $user->getRememberToken(), 120); // 120 minutes
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Cookie::queue(Cookie::forget('remember_token'));
        return redirect('/login');
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    public function redirectTo()
    {
        return $this->redirectTo;
    }
    public function login(Request $request)
    {
    $this->validateLogin($request);

    if ($this->attemptLogin($request)) {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        // Debugging
        \Log::info('User logged in successfully.');

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    // Debugging
    \Log::info('User failed to log in.');

    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
}
}
