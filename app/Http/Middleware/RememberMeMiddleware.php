<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RememberMeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('remember')) {
            Cookie::queue('remember_me', 'true', 60 * 1); // 1 menit
        } else {
            Cookie::queue(Cookie::forget('remember_me'));
        }

        return $next($request);
    }
}