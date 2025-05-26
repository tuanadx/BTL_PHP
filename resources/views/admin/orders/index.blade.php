@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quản lý đơn hàng</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->khachHang->ho_ten }}</td>
                            <td>{{ number_format($order->tong_tien, 0, ',', '.') }}đ</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge badge-{{ 
                                    $order->trang_thai === 'cho_xu_ly' ? 'warning' : 
                                    ($order->trang_thai === 'dang_giao' ? 'info' : 
                                    ($order->trang_thai === 'da_giao' ? 'success' : 
                                    ($order->trang_thai === 'da_huy' ? 'danger' : 'secondary'))) 
                                }}">
                                    @switch($order->trang_thai)
                                        @case('cho_xu_ly')
                                            Chờ xử lý
                                            @break
                                        @case('dang_giao')
                                            Đang giao hàng
                                            @break
                                        @case('da_giao')
                                            Đã giao hàng
                                            @break
                                        @case('da_huy')
                                            Đã hủy
                                            @break
                                        @default
                                            {{ $order->trang_thai }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" 
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Chi tiết
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 