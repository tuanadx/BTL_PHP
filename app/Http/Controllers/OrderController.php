<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userId = Auth::guard('khach_hang')->id();
            
            $query = DonHang::where('id_khach_hang', $userId)
                ->with(['chiTietDonHang.sach']);

            // Lọc theo trạng thái
            if ($request->has('status') && !empty($request->status)) {
                $query->where('trang_thai', $request->status);
            }

            // Sắp xếp
            $query->orderBy('created_at', 'desc');

            // Phân trang
            $orders = $query->paginate(10);

            return view('order.list', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        try {
            $userId = Auth::guard('khach_hang')->id();
            
            $order = DonHang::where('id', $id)
                ->where('id_khach_hang', $userId)
                ->with(['chiTietDonHang.sach'])
                ->firstOrFail();

            return view('cart.success', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('cart.view')
                ->with('error', 'Không tìm thấy đơn hàng');
        }
    }

    public function detail($id)
    {
        try {
            $userId = Auth::guard('khach_hang')->id();
            
            $order = DonHang::where('id', $id)
                ->where('id_khach_hang', $userId)
                ->with(['chiTietDonHang.sach'])
                ->firstOrFail();

            return view('order.detail', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('cart.view')
                ->with('error', 'Không tìm thấy đơn hàng');
        }
    }

    public function cancel($id)
    {
        try {
            $userId = Auth::guard('khach_hang')->id();
            
            $order = DonHang::where('id', $id)
                ->where('id_khach_hang', $userId)
                ->where('trang_thai','cho_xu_ly')
                ->firstOrFail();

            DB::beginTransaction();
            try {
                // Cập nhật trạng thái đơn hàng
                $order->trang_thai = 'da_huy';
                $order->save();

                // Hoàn lại số lượng sách
                foreach ($order->chiTietDonHang as $item) {
                    $book = $item->sach;
                    $book->so_luong += $item->so_luong;
                    $book->save();
                }

                DB::commit();

                return redirect()->route('order.detail', ['id' => $id])
                    ->with('success', 'Đã hủy đơn hàng thành công');
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Không thể hủy đơn hàng: ' . $e->getMessage());
        }
    }
} 