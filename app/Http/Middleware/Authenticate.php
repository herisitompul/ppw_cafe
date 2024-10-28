<?php
// app/Http/Middleware/Authenticate.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->guest()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            } else {
                $rememberToken = Cookie::get('remember_token');
                if ($rememberToken) {
                    $user = \App\Models\User::where('remember_token', $rememberToken)->first();
                    if ($user) {
                        Auth::login($user);
                        return $next($request);
                    }
                }
                return redirect()->guest(route('login'));
            }
        }

        return $next($request);
    }
}