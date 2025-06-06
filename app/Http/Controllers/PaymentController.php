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
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {
        try {
            $userId = Auth::guard('khach_hang')->id();
            if (!$userId) {
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán');
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
                return redirect()->route('cart.view')->with('error', 'Giỏ hàng trống');
            }

            $cartItems = ChiTietGioHang::where('id_gio_hang', $cart->id)
                ->with('sach')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.view')->with('error', 'Giỏ hàng trống');
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
                    'tong_tien' => $orderTotal, // Tổng tiền đã bao gồm VAT và phí ship
                    'trang_thai' => 'cho_xu_ly',
                    'trang_thai_thanh_toan' => 'chua_thanh_toan',
                    'dia_chi' => $request->dia_chi,
                    'ghi_chu' => $request->ghi_chu,
                    'ho_ten' => $request->ho_ten,
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'email' => $request->email,
                    'phi_van_chuyen' => $shipping,
                    'vat' => $vat,
                    'tong_tien_hang' => $subTotal
                ]);

                // Thêm chi tiết đơn hàng
                foreach ($cartItems as $item) {
                    \Log::info('Creating order detail:', [
                        'don_hang_id' => $order->id,
                        'sach_id' => $item->sach->id,
                        'so_luong' => $item->so_luong,
                        'don_gia' => $item->gia_tien
                    ]);

                    ChiTietDonHang::create([
                        'don_hang_id' => $order->id,
                        'sach_id' => $item->sach->id,
                        'so_luong' => $item->so_luong,
                        'don_gia' => $item->gia_tien
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

                // Cấu hình thanh toán VNPay
                $vnp_TmnCode = "MHYQQPRD";
                $vnp_HashSecret = "QT2ZRMVBM3PSTH96JXKUVR3GUBA5A8VF";
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_ReturnUrl = route('payment.return');
                
                // Tạo mã giao dịch unique bằng timestamp và order ID
                $timestamp = Carbon::now()->format('YmdHis');
                $vnp_TxnRef = $timestamp . '_' . $order->id;
                
                $vnp_OrderInfo = "Thanh toan don hang #" . $order->id;
                $vnp_OrderType = "billpayment";
                $vnp_Amount = $orderTotal * 100; // Tổng tiền đã bao gồm VAT và phí ship
                $vnp_Locale = "vn";
                $vnp_IpAddr = $request->ip();
                $vnp_CreateDate = date('YmdHis');

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => $vnp_CreateDate,
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_ReturnUrl,
                    "vnp_TxnRef" => $vnp_TxnRef
                );

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }

                // Trả về URL thanh toán VNPay dưới dạng JSON
                return response()->json([
                    'code' => '00',
                    'message' => 'success',
                    'data' => $vnp_Url
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                \Log::error('Payment Error: ' . $e->getMessage());
                throw $e;
            }
        } catch (Exception $e) {
            \Log::error('Payment Error: ' . $e->getMessage());
            return response()->json([
                'code' => '01',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function vnpay_return(Request $request)
    {
        \Log::info('VNPay Return Data:', $request->all());
        
        $vnp_TmnCode = "MHYQQPRD";
        $vnp_HashSecret = "QT2ZRMVBM3PSTH96JXKUVR3GUBA5A8VF";

        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        \Log::info('VNPay Input Data:', $inputData);

        if (!isset($inputData['vnp_SecureHash'])) {
            \Log::error('VNPay Secure Hash not found');
            return view('payment.result', [
                'success' => false,
                'message' => 'Không tìm thấy chữ ký xác thực'
            ]);
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        
        try {
            if (!isset($inputData['vnp_TxnRef'])) {
                \Log::error('VNPay Transaction Reference not found');
                return view('payment.result', [
                    'success' => false,
                    'message' => 'Không tìm thấy mã đơn hàng'
                ]);
            }

            $vnp_TxnRef = $inputData['vnp_TxnRef'];
            $orderId = explode('_', $vnp_TxnRef)[1]; // Lấy order ID từ mã tham chiếu

            \Log::info('Processing Order:', ['order_id' => $orderId]);

            // Tìm đơn hàng
            $order = DonHang::find($orderId);
            
            if (!$order) {
                \Log::error('Order not found:', ['order_id' => $orderId]);
                return view('payment.result', [
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ]);
            }

            // Kiểm tra chữ ký
            if ($secureHash === $vnp_SecureHash) {
                // Lấy kết quả thanh toán
                if (!isset($inputData['vnp_ResponseCode'])) {
                    \Log::error('VNPay Response Code not found');
                    return view('payment.result', [
                        'success' => false,
                        'message' => 'Không tìm thấy mã phản hồi'
                    ]);
                }

                $vnp_ResponseCode = $inputData['vnp_ResponseCode'];
                $vnpTranId = $inputData['vnp_TransactionNo']; // Mã giao dịch tại VNPAY
                $vnp_BankCode = $inputData['vnp_BankCode']; // Mã ngân hàng
                $vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán

                \Log::info('VNPay Response:', [
                    'response_code' => $vnp_ResponseCode,
                    'transaction_id' => $vnpTranId,
                    'bank_code' => $vnp_BankCode,
                    'amount' => $vnp_Amount
                ]);

                if ($vnp_ResponseCode == '00') {
                    // Thanh toán thành công
                    DB::beginTransaction();
                    try {
                        // Cập nhật trạng thái đơn hàng
                        $order->trang_thai_thanh_toan = 'da_thanh_toan_vnpay';
                        $order->ma_giao_dich_vnpay = $vnpTranId;
                        $order->ma_ngan_hang = $vnp_BankCode;
                        $order->ngay_thanh_toan = now();
                        $order->save();

                        DB::commit();
                        \Log::info('Payment successful, order updated:', ['order_id' => $order->id]);

                        // Trả về view kết quả thanh toán thành công
                        return view('payment.result', [
                            'success' => true,
                            'orderId' => $order->id,
                            'amount' => $vnp_Amount,
                            'paymentTime' => now()->format('H:i:s d/m/Y')
                        ]);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        \Log::error('Error updating order:', ['error' => $e->getMessage()]);
                        throw $e;
                    }
                } else {
                    // Thanh toán thất bại
                    \Log::warning('Payment failed:', ['response_code' => $vnp_ResponseCode]);
                    
                    // Cập nhật trạng thái đơn hàng
                    $order->trang_thai_thanh_toan = 'chua_thanh_toan';
                    $order->save();

                    return view('payment.result', [
                        'success' => false,
                        'message' => 'Thanh toán không thành công. Mã lỗi: ' . $vnp_ResponseCode
                    ]);
                }
            } else {
                // Chữ ký không hợp lệ
                \Log::error('Invalid signature');
                return view('payment.result', [
                    'success' => false,
                    'message' => 'Chữ ký không hợp lệ'
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Payment Error:', ['error' => $e->getMessage()]);
            return view('payment.result', [
                'success' => false,
                'message' => 'Đã có lỗi xảy ra trong quá trình xử lý thanh toán: ' . $e->getMessage()
            ]);
        }
    }
}
