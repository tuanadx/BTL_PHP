@extends('layouts.app')

@section('content')
<div class="order-detail-container">
    <div class="container">
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a href="{{ url('/user/orders') }}">Đơn hàng của tôi</a></li>
                    <li class="active">Chi tiết đơn hàng #{{ $order->id }}</li>
                </ul>
            </div>
        </div>

        <div class="order-detail-content">
            <div class="order-header">
                <h1>Chi tiết đơn hàng #{{ $order->id }}</h1>
                <div class="order-status {{ $order->trang_thai }}">
                    @switch($order->trang_thai)
                        @case('pending')
                            <i class="fas fa-clock"></i> Chờ xác nhận
                            @break
                        @case('confirmed')
                            <i class="fas fa-check"></i> Đã xác nhận
                            @break
                        @case('shipping')
                            <i class="fas fa-truck"></i> Đang giao hàng
                            @break
                        @case('completed')
                            <i class="fas fa-check-circle"></i> Đã giao hàng
                            @break
                        @case('cancelled')
                            <i class="fas fa-times-circle"></i> Đã hủy
                            @break
                        @default
                            {{ $order->trang_thai }}
                    @endswitch
                </div>
            </div>

            <div class="order-info">
                <div class="info-section">
                    <h2>Thông tin đơn hàng</h2>
                    <div class="info-content">
                        <div class="info-group">
                            <span class="label">Ngày đặt hàng:</span>
                            <span class="value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="info-group">
                            <span class="label">Phương thức thanh toán:</span>
                            <span class="value">
                                @if($order->phuong_thuc_thanh_toan == 'cod')
                                    Thanh toán khi nhận hàng (COD)
                                @else
                                    Chuyển khoản ngân hàng
                                @endif
                            </span>
                        </div>
                        @if($order->phuong_thuc_thanh_toan == 'bank_transfer')
                        <div class="bank-info">
                            <h3>Thông tin chuyển khoản</h3>
                            <div class="bank-details">
                                <p><strong>Ngân hàng:</strong> Vietcombank</p>
                                <p><strong>Số tài khoản:</strong> 1234567890</p>
                                <p><strong>Chủ tài khoản:</strong> NGUYEN VAN A</p>
                                <p><strong>Nội dung chuyển khoản:</strong> DH{{ $order->id }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="info-section">
                    <h2>Thông tin giao hàng</h2>
                    <div class="info-content">
                        <div class="info-group">
                            <span class="label">Người nhận:</span>
                            <span class="value">{{ $order->ho_ten_nguoi_nhan }}</span>
                        </div>
                        <div class="info-group">
                            <span class="label">Số điện thoại:</span>
                            <span class="value">{{ $order->so_dien_thoai }}</span>
                        </div>
                        <div class="info-group">
                            <span class="label">Địa chỉ:</span>
                            <span class="value">{{ $order->dia_chi }}</span>
                        </div>
                        @if($order->ghi_chu)
                        <div class="info-group">
                            <span class="label">Ghi chú:</span>
                            <span class="value">{{ $order->ghi_chu }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="order-items">
                <h2>Sản phẩm đã đặt</h2>
                <div class="items-list">
                    @foreach($order->chiTietDonHang as $item)
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

                <div class="order-summary">
                    <div class="summary-line">
                        <span>Tạm tính:</span>
                        <span>{{ number_format($order->tong_tien, 0, ',', '.') }}₫</span>
                    </div>
                    <div class="summary-line">
                        <span>VAT (10%):</span>
                        <span>{{ number_format($order->vat, 0, ',', '.') }}₫</span>
                    </div>
                    <div class="summary-line">
                        <span>Phí vận chuyển:</span>
                        <span>
                            @if($order->phi_van_chuyen > 0)
                                {{ number_format($order->phi_van_chuyen, 0, ',', '.') }}₫
                            @else
                                <span class="free-shipping">Miễn phí</span>
                            @endif
                        </span>
                    </div>
                    <div class="summary-line total">
                        <span>Tổng cộng:</span>
                        <span>{{ number_format($order->tong_thanh_toan, 0, ',', '.') }}₫</span>
                    </div>
                </div>
            </div>

            @if($order->trang_thai == 'pending')
            <div class="order-actions">
                <form action="{{ route('order.cancel', ['id' => $order->id]) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-cancel-order" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                        <i class="fas fa-times"></i>
                        Hủy đơn hàng
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.order-detail-container {
    padding: 40px 0;
}

.breadcrumb {
    margin-bottom: 30px;
    padding: 10px 0;
    background: #f8f9fa;
    border-radius: 5px;
}

.breadcrumb ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

.breadcrumb li {
    display: flex;
    align-items: center;
}

.breadcrumb li:not(:last-child)::after {
    content: '/';
    margin: 0 10px;
    color: #6c757d;
}

.breadcrumb a {
    color: #2a5a4c;
    text-decoration: none;
}

.breadcrumb .active {
    color: #6c757d;
}

.order-detail-content {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 30px;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

h1 {
    font-size: 24px;
    color: #2a5a4c;
    margin: 0;
}

.order-status {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.order-status i {
    font-size: 16px;
}

.order-status.pending {
    background: #fff3cd;
    color: #856404;
}

.order-status.confirmed {
    background: #cce5ff;
    color: #004085;
}

.order-status.shipping {
    background: #d4edda;
    color: #155724;
}

.order-status.completed {
    background: #d1e7dd;
    color: #0f5132;
}

.order-status.cancelled {
    background: #f8d7da;
    color: #721c24;
}

.order-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.info-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
}

h2 {
    font-size: 18px;
    color: #2a5a4c;
    margin-bottom: 20px;
}

.info-content {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.label {
    color: #6c757d;
    font-size: 14px;
}

.value {
    font-weight: 500;
}

.bank-info {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px dashed #dee2e6;
}

.bank-info h3 {
    font-size: 16px;
    color: #2a5a4c;
    margin-bottom: 15px;
}

.bank-details p {
    margin-bottom: 10px;
}

.order-items {
    margin-top: 40px;
}

.items-list {
    margin-bottom: 30px;
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #eee;
}

.item-info {
    display: flex;
    align-items: center;
    gap: 20px;
}

.item-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
}

.item-details h4 {
    font-size: 16px;
    margin-bottom: 10px;
}

.item-details p {
    color: #6c757d;
    margin-bottom: 5px;
}

.item-total {
    font-weight: 500;
    color: #2a5a4c;
}

.order-summary {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
    margin-top: 30px;
}

.summary-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.summary-line.total {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 2px solid #dee2e6;
    font-size: 18px;
    font-weight: 500;
}

.free-shipping {
    color: #28a745;
}

.order-actions {
    margin-top: 30px;
    padding-top: 30px;
    border-top: 1px solid #eee;
    text-align: right;
}

.btn-cancel-order {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: #dc3545;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-cancel-order:hover {
    background: #c82333;
}
</style>
@endpush 