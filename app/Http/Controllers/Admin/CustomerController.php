<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;
use App\Models\DonHang;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = KhachHang::where('role', 1)->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:khach_hang',
            'password' => 'required|string|min:6',
            'so_dien_thoai' => 'required|string|max:20',
            'dia_chi' => 'required|string|max:255',
        ], [
            'ho_ten.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'dia_chi.required' => 'Địa chỉ không được để trống',
        ]);

        KhachHang::create([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
            'role' => 1, // Khách hàng thường
        ]);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Thêm khách hàng mới thành công');
    }

    public function edit($id)
    {
        $customer = KhachHang::where('role', 1)->findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = KhachHang::where('role', 1)->findOrFail($id);

        $rules = [
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:khach_hang,email,'.$id,
            'so_dien_thoai' => 'required|string|max:20',
            'dia_chi' => 'required|string|max:255',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $request->validate($rules, [
            'ho_ten.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'dia_chi.required' => 'Địa chỉ không được để trống',
        ]);

        $data = [
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Cập nhật khách hàng thành công');
    }

    public function toggleStatus($id)
    {
        $customer = KhachHang::where('role', 1)->findOrFail($id);
        $customer->trang_thai = !$customer->trang_thai;
        $customer->save();

        $status = $customer->trang_thai ? 'hoạt động' : 'khóa';
        return redirect()->route('admin.customers.index')
            ->with('success', "Đã chuyển trạng thái khách hàng sang $status");
    }

    public function destroy($id)
    {
        $customer = KhachHang::where('role', 1)->findOrFail($id);
        
        // Kiểm tra xem khách hàng có đơn hàng không
        if ($customer->donHang()->exists()) {
            return redirect()->route('admin.customers.index')
                ->with('error', 'Không thể xóa khách hàng này vì đã có đơn hàng');
        }

        $customer->delete();
        return redirect()->route('admin.customers.index')
            ->with('success', 'Xóa khách hàng thành công');
    }

    public function show($id)
    {
        $customer = KhachHang::where('role', 1)->findOrFail($id);
        $orders = DonHang::where('id_khach_hang', $id)
            ->with(['chiTietDonHang.sach'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.customers.show', compact('customer', 'orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $customer = KhachHang::where('role', 1)->findOrFail($id);
        
        $request->validate([
            'trang_thai' => 'required|boolean'
        ], [
            'trang_thai.required' => 'Trạng thái không được để trống',
            'trang_thai.boolean' => 'Trạng thái không hợp lệ'
        ]);

        $customer->trang_thai = $request->trang_thai;
        $customer->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái khách hàng thành công');
    }
} 