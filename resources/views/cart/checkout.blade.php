@extends('layouts.app')

@section('content')
<div class="checkout-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout-section">
                    <h2>Thông tin giao hàng</h2>
                    <form id="checkoutForm" action="{{ route('cart.process-checkout') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ho_ten" class="form-label">Họ tên người nhận <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="{{ Auth::guard('khach_hang')->user()->ho_ten }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="so_dien_thoai" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="so_dien_thoai" name="so_dien_thoai" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::guard('khach_hang')->user()->email }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="dia_chi" class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="dia_chi" name="dia_chi" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ghi_chu" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="3"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="order-summary">
                    <h2>Đơn hàng của bạn</h2>
                    <div class="order-items">
                        @foreach($cartItems as $item)
                        <div class="order-item">
                            <div class="item-info">
                                <img src="{{ !empty($item->sach->anh) ? asset('storage/' . $item->sach->anh) : asset('images/default-book.jpg') }}" 
                                     alt="{{ $item->sach->ten_sach }}" class="item-image">
                                <div class="item-details">
                                    <h4>{{ $item->sach->ten_sach }}</h4>
                                    <p>Số lượng: {{ $item->so_luong }}</p>
                                    <p>Đơn giá: {{ number_format($item->gia_tien, 0, ',', '.') }}₫</p>
                                </div>
                            </div>
                            <div class="item-total">
                                {{ number_format($item->thanh_tien, 0, ',', '.') }}₫
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="order-totals">
                        <div class="total-line">
                            <span>Tạm tính:</span>
                            <span>{{ number_format($subTotal, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="total-line">
                            <span>VAT (10%):</span>
                            <span>{{ number_format($vat, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="total-line">
                            <span>Phí vận chuyển:</span>
                            <span>
                                @if($shipping > 0)
                                    {{ number_format($shipping, 0, ',', '.') }}₫
                                @else
                                    <span class="free-shipping">Miễn phí</span>
                                @endif
                            </span>
                        </div>
                        @if($shipping > 0)
                        <div class="shipping-note">
                            <i class="fas fa-info-circle"></i>
                            Mua thêm {{ number_format($free_shipping_threshold - $subTotal, 0, ',', '.') }}₫ để được miễn phí vận chuyển
                        </div>
                        @endif
                        <div class="total-line grand-total">
                            <span>Tổng cộng:</span>
                            <span>{{ number_format($orderTotal, 0, ',', '.') }}₫</span>
                        </div>
                    </div>
                    
                    <div class="payment-methods">
                        <h3>Phương thức thanh toán</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">
                                <i class="fas fa-money-bill-wave"></i>
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
                            <label class="form-check-label" for="bank_transfer">
                                <i class="fas fa-university"></i>
                                Chuyển khoản ngân hàng
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-place-order" form="checkoutForm">
                        Đặt hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.checkout-container {
    padding: 40px 0;
}

.checkout-section, .order-summary {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 30px;
    margin-bottom: 30px;
}

h2 {
    font-size: 24px;
    margin-bottom: 30px;
    color: #2a5a4c;
    position: relative;
    padding-bottom: 10px;
}

h2:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background-color: #2a5a4c;
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.item-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}

.item-details h4 {
    font-size: 16px;
    margin-bottom: 5px;
}

.item-details p {
    font-size: 14px;
    color: #666;
    margin-bottom: 3px;
}

.item-total {
    font-weight: 500;
    color: #2a5a4c;
}

.total-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px dashed #ddd;
}

.grand-total {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 2px solid #ddd;
    font-size: 18px;
    font-weight: 500;
}

.shipping-note {
    font-size: 14px;
    color: #666;
    margin: 10px 0;
}

.free-shipping {
    color: #28a745;
    font-weight: 500;
}

.payment-methods {
    margin-top: 30px;
}

.payment-methods h3 {
    font-size: 18px;
    margin-bottom: 20px;
}

.form-check {
    margin-bottom: 15px;
}

.form-check-label {
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn-place-order {
    width: 100%;
    padding: 15px;
    background-color: #2a5a4c;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 20px;
}

.btn-place-order:hover {
    background-color: #1e4438;
}
</style>
@endpush 