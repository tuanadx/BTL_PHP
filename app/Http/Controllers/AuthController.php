<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        $data = [
            'email' => old('email', ''),
            'password' => '',
            'email_err' => '',
            'password_err' => ''
        ];
        return view('user.login', compact('data'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        if (Auth::guard('khach_hang')->attempt($credentials)) {
            $request->session()->regenerate();
            
            // Kiểm tra role và chuyển hướng phù hợp
            $user = Auth::guard('khach_hang')->user();
            $redirectUrl = $user->role === 0 ? '/admin' : '/';
            
            return response()->json([
                'status' => 'success',
                'message' => 'Đăng nhập thành công',
                'redirect' => $redirectUrl
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email hoặc mật khẩu không chính xác'
        ], 401);
    }

    public function showRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:khach_hang',
            'password' => 'required|string|min:6|confirmed',
            'so_dien_thoai' => 'required|string|max:20',
            'dia_chi' => 'required|string|max:255',
        ], [
            'ho_ten.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'dia_chi.required' => 'Địa chỉ không được để trống',
        ]);

        try {
            $customer = KhachHang::create([
                'ho_ten' => $request->ho_ten,
                'email' => $request->email,
                'mat_khau' => Hash::make($request->password),
                'so_dien_thoai' => $request->so_dien_thoai,
                'dia_chi' => $request->dia_chi,
            ]);

            Auth::guard('khach_hang')->login($customer);

            return redirect('/')->with('success', 'Đăng ký thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi đăng ký. Vui lòng thử lại!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('khach_hang')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
