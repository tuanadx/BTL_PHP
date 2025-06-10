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
                    'message' => 'Không tìm thấy sách'
                ], 404);
            }

            // Kiểm tra số lượng sách có sẵn
            if ($book->so_luong < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => "Sách '{$book->ten_sach}' chỉ còn {$book->so_luong} cuốn trong kho"
                ], 400);
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
                    // Kiểm tra tổng số lượng sau khi thêm
                    $newQuantity = $cartDetail->so_luong + $quantity;
                    if ($book->so_luong < $newQuantity) {
                        return response()->json([
                            'success' => false,
                            'message' => "Sách '{$book->ten_sach}' chỉ còn {$book->so_luong} cuốn trong kho. Bạn đã có {$cartDetail->so_luong} cuốn trong giỏ hàng."
                        ], 400);
                    }
                    $cartDetail->so_luong = $newQuantity;
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
                // Người dùng chưa đăng nhập - lưu vào session
                $cart = session('cart', []);
                $found = false;
                foreach ($cart as $i => $item) {
                    if (($item['book_id'] ?? $item['id']) == $bookId) {
                        // Kiểm tra tổng số lượng sau khi thêm
                        $newQuantity = $item['quantity'] + $quantity;
                        if ($book->so_luong < $newQuantity) {
                            return response()->json([
                                'success' => false,
                                'message' => "Sách '{$book->ten_sach}' chỉ còn {$book->so_luong} cuốn trong kho. Bạn đã có {$item['quantity']} cuốn trong giỏ hàng."
                            ], 400);
                        }
                        $cart[$i]['quantity'] = $newQuantity;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $cart[] = [
                        'book_id' => $book->id,
                        'ten_sach' => $book->ten_sach,
                        'gia_tien' => $book->gia_tien,
                        'anh' => $book->anh,
                        'quantity' => $quantity
                    ];
                }
                session(['cart' => $cart]);
                $cartCount = array_sum(array_column($cart, 'quantity'));
                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm vào giỏ hàng tạm thời',
                    'cart_count' => $cartCount,
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
            // Lấy giỏ hàng tạm từ session cho khách chưa đăng nhập
            $cart = session('cart', []);
            $cartArr = [];
            $subTotal = 0;
            foreach ($cart as $item) {
                $item = array_merge([
                    'book_id' => null,
                    'ten_sach' => '',
                    'gia_tien' => 0,
                    'anh' => '',
                    'quantity' => 0
                ], $item);
                $item['thanh_tien'] = $item['gia_tien'] * $item['quantity'];
                $cartArr[] = (object)$item;
                $subTotal += $item['thanh_tien'];
            }
            $cartItems = collect($cartArr);
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
                'is_logged_in' => false
            ];
            return view('cart.index', compact('data'));
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
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'
                ], 404);
            }

            $cart = $cartDetail->gioHang;
            $cartDetail->delete();

            // Tính lại tổng tiền giỏ hàng
            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)->get();
            $subTotal = $cartItems->sum('thanh_tien');
            $vat = $subTotal * 0.1;
            $shipping = $subTotal >= 500000 ? 0 : 30000;
            $total = $subTotal + $vat + $shipping;
            $cartCount = $cartItems->count();

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa sản phẩm khỏi giỏ hàng',
                'subTotal' => $subTotal,
                'vat' => $vat,
                'shipping' => $shipping,
                'total' => $total,
                'cartCount' => $cartCount
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
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
                'so_dien_thoai' => 'required|string|max:20|regex:/^[0-9]+$/',
                'dia_chi' => 'required|string',
                'email' => 'required|email'
            ], [
                'ho_ten.required' => 'Vui lòng nhập họ tên người nhận',
                'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại người nhận',
                'so_dien_thoai.regex' => 'Số điện thoại chỉ được chứa số',
                'dia_chi.required' => 'Vui lòng nhập địa chỉ giao hàng',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng'
            ]);
            
            // Lấy giỏ hàng active của user
            $cart = GioHang::where('id_khach_hang', $userId)
                ->where('trang_thai', 'active')
                ->first();

            if (!$cart) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Giỏ hàng trống'
                ], 400);
            }

            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)
                ->with('sach')
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Giỏ hàng trống'
                ], 400);
            }

            // Kiểm tra số lượng sách có sẵn trước khi tạo đơn hàng
            foreach ($cartItems as $item) {
                $book = $item->sach;
                if ($book->so_luong < $item->so_luong) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Sách '{$book->ten_sach}' chỉ còn {$book->so_luong} cuốn trong kho"
                    ], 400);
                }
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
                    'tong_tien' => $orderTotal,
                    'trang_thai' => 'cho_xu_ly',
                    'trang_thai_thanh_toan' => 'chua_thanh_toan',
                    'dia_chi' => $request->dia_chi,
                    'ghi_chu' => $request->ghi_chu,
                    'ho_ten' => $request->ho_ten,
                    'sdt_nguoi_nhan' => $request->input('so_dien_thoai', ''),
                    'email' => $request->email,
                    'phi_van_chuyen' => $shipping,
                    'vat' => $vat,
                    'tong_tien_hang' => $subTotal,
                    'phuong_thuc_thanh_toan' => 'cod'
                ]);

                // Thêm chi tiết đơn hàng và cập nhật số lượng sách
                foreach ($cartItems as $item) {
                    // Khóa sách để tránh race condition
                    $book = Sach::lockForUpdate()->find($item->sach->id);
                    
                    // Kiểm tra lại số lượng sau khi khóa
                    if ($book->so_luong < $item->so_luong) {
                        throw new Exception("Sách '{$book->ten_sach}' chỉ còn {$book->so_luong} cuốn trong kho");
                    }

                    ChiTietDonHang::create([
                        'don_hang_id' => $order->id,
                        'sach_id' => $book->id,
                        'so_luong' => $item->so_luong,
                        'don_gia' => $book->gia_tien
                    ]);

                    // Cập nhật số lượng sách
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
                    'status' => 'success',
                    'message' => 'Đặt hàng thành công'
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Gọi hàm này sau khi đăng nhập thành công để merge session cart vào DB
    public static function mergeSessionCartToDb($userId)
    {
        $cart = session('cart', []);
        if (empty($cart)) return;
        $gioHang = GioHang::firstOrCreate([
            'id_khach_hang' => $userId,
            'trang_thai' => 'active'
        ], [
            'tong_tien' => 0
        ]);
        foreach ($cart as $item) {
            $bookId = $item['book_id'] ?? $item['id'] ?? null;
            $quantity = $item['quantity'] ?? 1;
            $book = Sach::find($bookId);
            if ($book) {
                $cartDetail = ChiTietGioHang::where('id_gio_hang', $gioHang->id)
                    ->where('id_sach', $bookId)
                    ->first();
                if ($cartDetail) {
                    $cartDetail->so_luong += $quantity;
                    $cartDetail->save();
                } else {
                    ChiTietGioHang::create([
                        'id_gio_hang' => $gioHang->id,
                        'id_sach' => $bookId,
                        'so_luong' => $quantity,
                        'gia_tien' => $book->gia_tien
                    ]);
                }
            }
        }
        $gioHang->capNhatTongTien();
        session()->forget('cart');
    }
}
