@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    @if($success)
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 64px;"></i>
                        </div>
                        <h2 class="card-title text-success">Thanh toán thành công!</h2>
                        <p class="card-text">Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đã được xác nhận.</p>
                        <div class="mt-4">
                            <p>{{ $orderId }}</p>
                            <p><strong>Số tiền:</strong> {{ number_format($amount) }}đ</p>
                            <p><strong>Thời gian:</strong> {{ $paymentTime }}</p>
                        </div>
                    @else
                        <div class="mb-4">
                            <i class="fas fa-times-circle text-danger" style="font-size: 64px;"></i>
                        </div>
                        <h2 class="card-title text-danger">Thanh toán thất bại!</h2>
                        <p class="card-text">{{ $message ?? 'Đã có lỗi xảy ra trong quá trình thanh toán.' }}</p>
                    @endif

                    <div class="mt-4">
                        <a href="/" class="btn btn-primary">Về trang chủ</a>
                        <a href="{{ route('order.list') }}" class="btn btn-success">Xem đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 