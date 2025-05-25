<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserSession
{
    public function handle(Request $request, Closure $next)
    {
        // Jika belum login dan bukan halaman publik
        if (!session()->has('user_data') && !$request->is('/') && !$request->is('about') && !$request->is('contact') && !$request->is('login') && !$request->is('register')) {
            return redirect()->route('user.login');
        }

        return $next($request);
    }
}
