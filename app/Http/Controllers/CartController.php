<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\Sach;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            \Log::info('Add to cart request:', [
                'book_id' => $request->input('book_id'),
                'quantity' => $request->input('quantity'),
                'user_id' => Auth::guard('khach_hang')->id(),
                'request_headers' => $request->headers->all()
            ]);

            $bookId = $request->input('book_id');
            $quantity = $request->input('quantity', 1);
            
            $book = Sach::find($bookId);
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sách không tồn tại'
                ], 404);
            }

            if (Auth::guard('khach_hang')->check()) {
                // Người dùng đã đăng nhập - lưu vào database
                $userId = Auth::guard('khach_hang')->id();
                
                // Tìm hoặc tạo giỏ hàng active của user
                $cart = GioHang::firstOrCreate(
                    [
                        'id_khach_hang' => $userId,
                        'trang_thai' => 'active'
                    ],
                    [
                        'tong_tien' => 0
                    ]
                );

                // Tìm chi tiết giỏ hàng nếu đã có sách này
                $cartDetail = ChiTietGioHang::where('id_gio_hang', $cart->id)
                    ->where('id_sach', $bookId)
                    ->first();

                if ($cartDetail) {
                    // Cập nhật số lượng nếu đã có
                    $cartDetail->so_luong += $quantity;
                    $cartDetail->save();
                } else {
                    // Thêm mới chi tiết giỏ hàng
                    ChiTietGioHang::create([
                        'id_gio_hang' => $cart->id,
                        'id_sach' => $bookId,
                        'so_luong' => $quantity,
                        'gia_tien' => $book->gia_tien
                    ]);
                }

                // Cập nhật tổng tiền giỏ hàng
                $cart->capNhatTongTien();

                // Đếm số lượng sản phẩm trong giỏ hàng
                $cartCount = ChiTietGioHang::where('id_gio_hang', $cart->id)->sum('so_luong');

                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm vào giỏ hàng',
                    'cart_count' => $cartCount
                ]);
            } else {
                // Người dùng chưa đăng nhập - trả về thông tin sách để lưu vào localStorage
                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm vào giỏ hàng tạm thời',
                    'book' => [
                        'id' => $book->id,
                        'ten_sach' => $book->ten_sach,
                        'gia_tien' => $book->gia_tien,
                        'anh' => $book->anh,
                        'quantity' => $quantity
                    ]
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function viewCart()
    {
        if (!Auth::guard('khach_hang')->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng');
        }

        try {
            $userId = Auth::guard('khach_hang')->id();
            
            // Lấy giỏ hàng active của user
            $cart = GioHang::where('id_khach_hang', $userId)
                ->where('trang_thai', 'active')
                ->first();

            if (!$cart) {
                return view('cart.index', [
                    'data' => [
                        'cartItems' => collect(),
                        'subTotal' => 0,
                        'vat' => 0,
                        'shipping' => 30000,
                        'orderTotal' => 30000,
                        'free_shipping_threshold' => 500000,
                        'is_logged_in' => true
                    ]
                ]);
            }

            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)
                ->with('sach')
                ->get();

            $subTotal = $cartItems->sum('thanh_tien');
            $vat = $subTotal * 0.1;
            $shipping = $subTotal >= 500000 ? 0 : 30000;
            $orderTotal = $subTotal + $vat + $shipping;

            $data = [
                'cartItems' => $cartItems,
                'subTotal' => $subTotal,
                'vat' => $vat,
                'shipping' => $shipping,
                'orderTotal' => $orderTotal,
                'free_shipping_threshold' => 500000,
                'is_logged_in' => true
            ];

            return view('cart.index', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function mergeCart(Request $request)
    {
        if (!Auth::guard('khach_hang')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $userId = Auth::guard('khach_hang')->id();
            $localCart = $request->input('localCart', []);

            // Tìm hoặc tạo giỏ hàng active
            $cart = GioHang::firstOrCreate(
                [
                    'id_khach_hang' => $userId,
                    'trang_thai' => 'active'
                ],
                [
                    'tong_tien' => 0
                ]
            );
            
            foreach ($localCart as $item) {
                $book = Sach::find($item['id']);
                if ($book) {
                    $cartDetail = ChiTietGioHang::where('id_gio_hang', $cart->id)
                        ->where('id_sach', $item['id'])
                        ->first();

                    if ($cartDetail) {
                        $cartDetail->so_luong += $item['quantity'];
                        $cartDetail->save();
                    } else {
                        ChiTietGioHang::create([
                            'id_gio_hang' => $cart->id,
                            'id_sach' => $item['id'],
                            'so_luong' => $item['quantity'],
                            'gia_tien' => $book->gia_tien
                        ]);
                    }
                }
            }

            // Cập nhật tổng tiền
            $cart->capNhatTongTien();

            return response()->json(['message' => 'Giỏ hàng đã được đồng bộ thành công']);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Có lỗi xảy ra',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateQuantity(Request $request)
    {
        if (!Auth::guard('khach_hang')->check()) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập'], 401);
        }

        try {
            $userId = Auth::guard('khach_hang')->id();
            $cartDetailId = $request->input('cart_detail_id');
            $quantity = $request->input('quantity');

            // Validate input
            if (!$cartDetailId || !$quantity || $quantity < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Thông tin không hợp lệ'
                ], 400);
            }

            $cartDetail = ChiTietGioHang::whereHas('gioHang', function($query) use ($userId) {
                $query->where('id_khach_hang', $userId)
                    ->where('trang_thai', 'active');
            })->where('id', $cartDetailId)
            ->first();

            if (!$cartDetail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'
                ], 404);
            }

            // Check if quantity is available
            if ($quantity > $cartDetail->sach->so_luong) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng yêu cầu vượt quá số lượng có sẵn'
                ], 400);
            }

            $cartDetail->so_luong = $quantity;
            $cartDetail->save();

            // Cập nhật tổng tiền giỏ hàng
            $cart = $cartDetail->gioHang;
            $cart->capNhatTongTien();

            // Tính lại tổng tiền
            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)->get();
            $subTotal = $cartItems->sum('thanh_tien');
            $vat = $subTotal * 0.1;
            $shipping = $subTotal >= 500000 ? 0 : 30000;
            $orderTotal = $subTotal + $vat + $shipping;

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật số lượng',
                'subTotal' => $subTotal,
                'vat' => $vat,
                'shipping' => $shipping,
                'orderTotal' => $orderTotal,
                'free_shipping_threshold' => 500000
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeItem(Request $request)
    {
        if (!Auth::guard('khach_hang')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $userId = Auth::guard('khach_hang')->id();
            $cartDetailId = $request->input('cart_detail_id');

            $cartDetail = ChiTietGioHang::whereHas('gioHang', function($query) use ($userId) {
                $query->where('id_khach_hang', $userId)
                    ->where('trang_thai', 'active');
            })->where('id', $cartDetailId)
            ->first();

            if (!$cartDetail) {
                return response()->json(['error' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 404);
            }

            $cart = $cartDetail->gioHang;
            $cartDetail->delete();

            // Cập nhật tổng tiền giỏ hàng
            $cart->capNhatTongTien();

            // Tính lại tổng tiền
            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)->get();
            $subTotal = $cartItems->sum('thanh_tien');
            $vat = $subTotal * 0.1;
            $shipping = $subTotal >= 500000 ? 0 : 30000;
            $orderTotal = $subTotal + $vat + $shipping;

            return response()->json([
                'message' => 'Đã xóa sản phẩm khỏi giỏ hàng',
                'cartItems' => $cartItems,
                'subTotal' => $subTotal,
                'vat' => $vat,
                'shipping' => $shipping,
                'orderTotal' => $orderTotal,
                'free_shipping_threshold' => 500000,
                'is_empty' => $cartItems->isEmpty()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Có lỗi xảy ra',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function checkout()
    {
        try {
            $userId = Auth::guard('khach_hang')->id();
            
            // Lấy giỏ hàng active của user
            $cart = GioHang::where('id_khach_hang', $userId)
                ->where('trang_thai', 'active')
                ->first();

            if (!$cart) {
                return redirect()->route('cart.view')->with('error', 'Giỏ hàng trống');
            }

            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)
                ->with('sach')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.view')->with('error', 'Giỏ hàng trống');
            }

            $subTotal = $cartItems->sum('thanh_tien');
            $vat = $subTotal * 0.1;
            $shipping = $subTotal >= 500000 ? 0 : 30000;
            $orderTotal = $subTotal + $vat + $shipping;

            return view('cart.checkout', [
                'cartItems' => $cartItems,
                'subTotal' => $subTotal,
                'vat' => $vat,
                'shipping' => $shipping,
                'orderTotal' => $orderTotal,
                'free_shipping_threshold' => 500000
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function processCheckout(Request $request)
    {
        try {
            $userId = Auth::guard('khach_hang')->id();
            
            // Validate input
            $request->validate([
                'ho_ten' => 'required|string|max:255',
                'so_dien_thoai' => 'required|string|max:20',
                'dia_chi' => 'required|string',
                'payment_method' => 'required|in:cod,bank_transfer'
            ]);
            
            // Lấy giỏ hàng active của user
            $cart = GioHang::where('id_khach_hang', $userId)
                ->where('trang_thai', 'active')
                ->first();

            if (!$cart) {
                return redirect()->route('cart.view')->with('error', 'Giỏ hàng trống');
            }

            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)
                ->with('sach')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.view')->with('error', 'Giỏ hàng trống');
            }

            // Tính tổng tiền
            $subTotal = $cartItems->sum('thanh_tien');
            $vat = $subTotal * 0.1;
            $shipping = $subTotal >= 500000 ? 0 : 30000;
            $orderTotal = $subTotal + $vat + $shipping;

            // Tạo đơn hàng
            DB::beginTransaction();
            try {
                // Tạo đơn hàng mới
                $order = DonHang::create([
                    'id_khach_hang' => $userId,
                    'ho_ten_nguoi_nhan' => $request->ho_ten,
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'dia_chi' => $request->dia_chi,
                    'ghi_chu' => $request->ghi_chu,
                    'phuong_thuc_thanh_toan' => $request->payment_method,
                    'tong_tien' => $subTotal,
                    'phi_van_chuyen' => $shipping,
                    'vat' => $vat,
                    'tong_thanh_toan' => $orderTotal,
                    'trang_thai' => 'pending'
                ]);

                // Thêm chi tiết đơn hàng
                foreach ($cartItems as $item) {
                    ChiTietDonHang::create([
                        'id_don_hang' => $order->id,
                        'id_sach' => $item->id_sach,
                        'so_luong' => $item->so_luong,
                        'gia_tien' => $item->gia_tien,
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

                return redirect()->route('order.success', ['id' => $order->id])
                    ->with('success', 'Đặt hàng thành công!');
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
                ->withInput();
        }
    }
} 