@extends('layouts.app')

@section('content')
<div class="success-container">
    @if($success)
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h2 class="success-title">Thanh toán thành công!</h2>
        <p class="success-message">Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đã được xác nhận.</p>
        
        <div class="order-details">
            <p><strong>Số đơn hàng:</strong> {{ $orderId }}</p>
            <p><strong>Số tiền:</strong> {{ number_format($amount) }}đ</p>
            <p><strong>Thời gian:</strong> {{ $paymentTime }}</p>
        </div>
    @else
        <div class="success-icon" style="background: #dc3545;">
            <i class="fas fa-times"></i>
        </div>
        <h2 class="success-title" style="color: #dc3545;">Thanh toán thất bại!</h2>
        <p class="success-message">{{ $message ?? 'Đã có lỗi xảy ra trong quá trình thanh toán.' }}</p>
    @endif

    <div class="success-buttons">
        <a href="/" class="btn-home">Về trang chủ</a>
        <a href="{{ route('order.list') }}" class="btn-order">Xem đơn hàng</a>
    </div>
</div>
@endsection 