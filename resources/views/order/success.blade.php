@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 64px;"></i>
                    </div>
                    <h2 class="card-title text-success">Đặt hàng thành công!</h2>
                    <p class="card-text">Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đã được xác nhận.</p>
                    
                    <div class="order-info mt-4">
                        <h4>Thông tin đơn hàng #{{ $order->id }}</h4>
                        <p><strong>Người nhận:</strong> {{ $order->ho_ten }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->so_dien_thoai }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->dia_chi }}</p>
                        <p><strong>Tổng tiền:</strong> {{ number_format($order->tong_tien, 0, ',', '.') }}₫</p>
                        <p><strong>Phương thức thanh toán:</strong> 
                            @if($order->phuong_thuc_thanh_toan == 'cod')
                                Thanh toán khi nhận hàng (COD)
                            @else
                                Thanh toán qua VNPAY
                            @endif
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">Về trang chủ</a>
                        <a href="{{ route('order.detail', ['id' => $order->id]) }}" class="btn btn-success">Xem chi tiết đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.order-info {
    text-align: left;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
    margin: 20px 0;
}

.order-info h4 {
    color: #28a745;
    margin-bottom: 15px;
}

.order-info p {
    margin-bottom: 10px;
}

.btn {
    margin: 0 5px;
}
</style>
@endpush
@endsection 