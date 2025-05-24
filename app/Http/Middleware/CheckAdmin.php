<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('khach_hang')->check() && Auth::guard('khach_hang')->user()->role === 0) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này');
    }
} 