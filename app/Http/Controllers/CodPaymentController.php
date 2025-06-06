<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class CodPaymentController extends Controller
{
    public function processCodPayment(Request $request)
    {
        try {
            $userId = Auth::guard('khach_hang')->id();
            if (!$userId) {
                return response()->json([
                    'code' => '01',
                    'message' => 'Vui lòng đăng nhập để thanh toán'
                ], 401);
            }
            
            // Validate input
            $request->validate([
                'ho_ten' => 'required|string|max:255',
                'so_dien_thoai' => 'required|string|max:20',
                'dia_chi' => 'required|string'
            ]);
            
            // Lấy giỏ hàng active của user
            $cart = GioHang::where('id_khach_hang', $userId)
                ->where('trang_thai', 'active')
                ->first();

            if (!$cart) {
                return response()->json([
                    'code' => '01',
                    'message' => 'Giỏ hàng trống'
                ], 400);
            }

            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)
                ->with('sach')
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'code' => '01',
                    'message' => 'Giỏ hàng trống'
                ], 400);
            }

            // Tính tổng tiền hàng
            $subTotal = $cartItems->sum('thanh_tien');

            // Tính VAT (10%)
            $vat = $subTotal * 0.1;

            // Tính phí vận chuyển
            $shipping = 0;
            if ($subTotal < 300000) { // Giả sử free ship cho đơn hàng từ 300k
                $shipping = 30000; // Phí ship mặc định 30k
            }

            // Tổng tiền cuối cùng
            $orderTotal = $subTotal + $vat + $shipping;

            // Tạo đơn hàng
            DB::beginTransaction();
            try {
                // Tạo đơn hàng mới
                $order = DonHang::create([
                    'id_khach_hang' => $userId,
                    'tong_tien' => $orderTotal,
                    'trang_thai' => 'cho_xu_ly',
                    'trang_thai_thanh_toan' => 'chua_thanh_toan', // COD chưa thanh toán
                    'dia_chi' => $request->dia_chi,
                    'ghi_chu' => $request->ghi_chu,
                    'ho_ten' => $request->ho_ten,
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'email' => $request->email,
                    'phi_van_chuyen' => $shipping,
                    'vat' => $vat,
                    'tong_tien_hang' => $subTotal,
                    'phuong_thuc_thanh_toan' => 'cod'
                ]);

                // Thêm chi tiết đơn hàng
                foreach ($cartItems as $item) {
                    ChiTietDonHang::create([
                        'don_hang_id' => $order->id,
                        'sach_id' => $item->sach->id,
                        'so_luong' => $item->so_luong,
                        'don_gia' => $item->gia_tien,
                        'thanh_tien' => $item->thanh_tien
                    ]);

                    // Cập nhật số lượng sách
                    $book = $item->sach;
                    $book->so_luong -= $item->so_luong;
                    $book->save();
                }

                // Đánh dấu giỏ hàng đã hoàn thành
                $cart->trang_thai = 'completed';
                $cart->save();

                DB::commit();

                // Xóa session cart_count
                session()->forget('cart_count');

                return response()->json([
                    'code' => '00',
                    'message' => 'Đặt hàng thành công',
                    'data' => route('order.success', ['id' => $order->id])
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                \Log::error('COD Payment Error: ' . $e->getMessage());
                throw $e;
            }
        } catch (Exception $e) {
            \Log::error('COD Payment Error: ' . $e->getMessage());
            return response()->json([
                'code' => '01',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
} 