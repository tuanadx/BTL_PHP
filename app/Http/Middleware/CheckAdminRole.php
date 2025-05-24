<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('khach_hang')->check()) {
            return redirect('/users/login')->with('error', 'Vui lòng đăng nhập để tiếp tục!');
        }

        if (Auth::guard('khach_hang')->user()->role === 0) {
            return $next($request);
        }

        if (Auth::guard('khach_hang')->user()->role === 1) {
            return redirect('/')->with('info', 'Bạn đang truy cập với tài khoản khách hàng.');
        }

        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này!');
    }
} 