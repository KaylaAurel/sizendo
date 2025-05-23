<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
{
    if (!$request->session()->has('admin_data')) {
        return redirect()->route('admin.login')->with('error', 'Silakan     login sebagai admin terlebih dahulu.');
    }

    return $next($request);
    }

}
