<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Hiển thị thông tin tài khoản
     */
    public function profile()
    {
        $user = Auth::guard('khach_hang')->user();
        return view('user.profile', compact('user'));
    }

    /**
     * Hiển thị form chỉnh sửa thông tin
     */
    public function editProfile()
    {
        $user = Auth::guard('khach_hang')->user();
        return view('user.edit_profile', compact('user'));
    }

    /**
     * Cập nhật thông tin tài khoản
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::guard('khach_hang')->user();
        
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi' => 'nullable|string|max:500',
            'ngay_sinh' => 'nullable|date',
            'gioi_tinh' => 'nullable|in:Nam,Nữ,Khác'
        ], [
            'ho_ten.required' => 'Họ tên không được để trống',
            'ho_ten.max' => 'Họ tên không được vượt quá 255 ký tự',
            'so_dien_thoai.max' => 'Số điện thoại không hợp lệ',
            'dia_chi.max' => 'Địa chỉ không được vượt quá 500 ký tự',
            'ngay_sinh.date' => 'Ngày sinh không hợp lệ',
            'gioi_tinh.in' => 'Giới tính không hợp lệ'
        ]);

        try {
            $user->update([
                'ho_ten' => $request->ho_ten,
                'so_dien_thoai' => $request->so_dien_thoai,
                'dia_chi' => $request->dia_chi,
                'ngay_sinh' => $request->ngay_sinh,
                'gioi_tinh' => $request->gioi_tinh
            ]);

            // Cập nhật tên trong session
            session(['user_name' => $user->ho_ten]);

            return redirect()->route('profile')->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi cập nhật thông tin. Vui lòng thử lại!');
        }
    }

    /**
     * Hiển thị form đổi mật khẩu
     */
    public function changePassword()
    {
        return view('user.change_password');
    }

    /**
     * Cập nhật mật khẩu
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::guard('khach_hang')->user();
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password'
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự',
            'confirm_new_password.required' => 'Vui lòng xác nhận mật khẩu mới',
            'confirm_new_password.same' => 'Xác nhận mật khẩu không khớp'
        ]);

        if (!Hash::check($request->current_password, $user->mat_khau)) {
            return back()->with('error', 'Mật khẩu hiện tại không chính xác');
        }

        try {
            $user->update([
                'mat_khau' => Hash::make($request->new_password)
            ]);

            return redirect()->route('profile')->with('success', 'Đổi mật khẩu thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi đổi mật khẩu. Vui lòng thử lại!');
        }
    }
} 