@extends('layouts.app')

@section('content')
<div class="orders-container">
    <div class="container">
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="active">Đơn hàng của tôi</li>
                </ul>
            </div>
        </div>

        <div class="orders-content">
            <h1>Đơn hàng của tôi</h1>

            <div class="order-filters">
                <form action="{{ route('order.list') }}" method="GET" class="filter-form">
                    <div class="form-group">
                        <label for="status">Trạng thái:</label>
                        <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Tất cả</option>
                            <option value="cho_xu_ly" {{ request('status') == 'cho_xu_ly' ? 'selected' : '' }}>Chờ Xử Lý</option>
                            
                            <option value="dang_giao" {{ request('status') == 'dang_giao_hang' ? 'selected' : '' }}>Đang giao hàng</option>
                            <option value="da_giao" {{ request('status') == 'da_giao_hang' ? 'selected' : '' }}>Đã giao hàng</option>
                            <option value="da_huy" {{ request('status') == 'da_huy' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                </form>
            </div>

            @if($orders->isEmpty())
            <div class="empty-orders">
                <div class="empty-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <p>Bạn chưa có đơn hàng nào</p>
                <a href="{{ url('/') }}" class="btn-shop-now">
                    <i class="fas fa-shopping-cart"></i>
                    Mua sắm ngay
                </a>
            </div>
            @else
            <div class="orders-list">
                @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-info">
                            <span class="order-id">Đơn hàng #{{ $order->id }}</span>
                            <span class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="order-status {{ $order->trang_thai }}">
                            @switch($order->trang_thai)
                                @case('cho_xu_ly')
                                    <i class="fas fa-clock"></i> Chờ xử lý
                                    @break
                               
                                @case('dang_giao')
                                    <i class="fas fa-truck"></i> Đang giao hàng
                                    @break
                                @case('da_giao')
                                    <i class="fas fa-check-circle"></i> Đã giao hàng
                                    @break
                                @case('da_huy')
                                    <i class="fas fa-times-circle"></i> Đã hủy
                                    @break
                                @default
                                    {{ $order->trang_thai }}
                            @endswitch
                        </div>
                    </div>

                    <div class="order-items">
                        @foreach($order->chiTietDonHang->take(2) as $item)
                        <div class="order-item">
                            <div class="item-info">
                                <img src="{{ !empty($item->sach->anh) ? asset('storage/books/' . basename($item->sach->anh)) : asset('images/default-book.jpg') }}" 
                                     alt="{{ $item->sach->ten_sach }}" class="item-image">
                                <div class="item-details">
                                    <h4>{{ $item->sach->ten_sach }}</h4>
                                    <p>Số lượng: {{ $item->so_luong }}</p>
                                    <p>Đơn giá: {{ number_format($item->don_gia, 0, ',', '.') }}₫</p>
                                    <p>Thành tiền: {{ number_format($item->so_luong * $item->don_gia, 0, ',', '.') }}₫</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($order->chiTietDonHang->count() > 2)
                        <div class="more-items">
                            và {{ $order->chiTietDonHang->count() - 2 }} sản phẩm khác
                        </div>
                        @endif
                    </div>

                    <div class="order-footer">
                        <div class="order-total">
                            <span>Tổng tiền:</span>
                            <span class="total-amount">{{ number_format($order->tong_tien, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="order-actions">
                            <a href="{{ route('order.detail', ['id' => $order->id]) }}" class="btn-view-order">
                                <i class="fas fa-eye"></i>
                                Xem chi tiết
                            </a>
                            @if($order->trang_thai == 'cho_xu_ly')
                            <form action="{{ route('order.cancel', ['id' => $order->id]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-cancel-order" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                    <i class="fas fa-times"></i>
                                    Hủy đơn hàng
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pagination-container">
                {{ $orders->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.orders-container {
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

.orders-content {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 30px;
}

h1 {
    font-size: 24px;
    color: #2a5a4c;
    margin-bottom: 30px;
}

.order-filters {
    margin-bottom: 30px;
}

.filter-form {
    display: flex;
    gap: 20px;
    align-items: center;
}

.form-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-control {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
}

.empty-orders {
    text-align: center;
    padding: 60px 0;
}

.empty-icon {
    font-size: 64px;
    color: #6c757d;
    margin-bottom: 20px;
}

.btn-shop-now {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #2a5a4c;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s;
}

.btn-shop-now:hover {
    background: #1e4438;
    color: #fff;
}

.order-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    margin-bottom: 20px;
    overflow: hidden;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #f8f9fa;
    border-bottom: 1px solid #eee;
}

.order-info {
    display: flex;
    gap: 20px;
}

.order-id {
    font-weight: 500;
}

.order-date {
    color: #6c757d;
}

.order-status {
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
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

.order-items {
    padding: 20px;
}

.order-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.order-item:last-child {
    border-bottom: none;
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
    color: #6c757d;
    margin-bottom: 3px;
}

.more-items {
    text-align: center;
    padding: 10px;
    color: #6c757d;
    font-style: italic;
}

.order-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #f8f9fa;
    border-top: 1px solid #eee;
}

.order-total {
    font-weight: 500;
}

.total-amount {
    color: #2a5a4c;
    margin-left: 10px;
}

.order-actions {
    display: flex;
    gap: 10px;
}

.btn-view-order, .btn-cancel-order {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: background-color 0.3s;
}

.btn-view-order {
    background: #2a5a4c;
    color: #fff;
}

.btn-view-order:hover {
    background: #1e4438;
    color: #fff;
}

.btn-cancel-order {
    background: #dc3545;
    color: #fff;
    border: none;
    cursor: pointer;
}

.btn-cancel-order:hover {
    background: #c82333;
}

.pagination-container {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    gap: 5px;
}

.page-link {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #2a5a4c;
    text-decoration: none;
    transition: all 0.3s;
}

.page-link:hover {
    background: #2a5a4c;
    color: #fff;
    border-color: #2a5a4c;
}

.page-item.active .page-link {
    background: #2a5a4c;
    color: #fff;
    border-color: #2a5a4c;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background: #f8f9fa;
}
</style>
@endpush 