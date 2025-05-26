@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin khách hàng</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Họ tên:</strong> {{ $customer->ho_ten }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong> {{ $customer->email }}
                    </div>
                    <div class="mb-3">
                        <strong>Số điện thoại:</strong> {{ $customer->so_dien_thoai }}
                    </div>
                    <div class="mb-3">
                        <strong>Địa chỉ:</strong> {{ $customer->dia_chi }}
                    </div>
                    <div class="mb-3">
                        <strong>Ngày sinh:</strong> {{ $customer->ngay_sinh ? $customer->ngay_sinh->format('d/m/Y') : 'Chưa cập nhật' }}
                    </div>
                    <div class="mb-3">
                        <strong>Giới tính:</strong> {{ $customer->gioi_tinh ?: 'Chưa cập nhật' }}
                    </div>
                    <div class="mb-3">
                        <strong>Ngày đăng ký:</strong> {{ $customer->ngay_dang_ky ? $customer->ngay_dang_ky->format('d/m/Y H:i') : 'N/A' }}
                    </div>
                    <div class="mb-4">
                        <strong>Trạng thái:</strong>
                        <span class="badge badge-{{ $customer->trang_thai ? 'success' : 'danger' }}" style="{{ $customer->trang_thai ? 'color: #28a745; background-color: #d4edda; border-color: #c3e6cb;' : '' }}">
                            {{ $customer->trang_thai ? 'Đang hoạt động' : 'Đã khóa' }}
                        </span>
                    </div>

                    <form action="{{ route('admin.customers.update-status', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="trang_thai" value="{{ $customer->trang_thai ? '0' : '1' }}">
                        <button type="submit" class="btn btn-{{ $customer->trang_thai ? 'danger' : 'success' }} btn-block">
                            <i class="fas fa-{{ $customer->trang_thai ? 'lock' : 'unlock' }}"></i>
                            {{ $customer->trang_thai ? 'Khóa tài khoản' : 'Mở khóa tài khoản' }}
                        </button>
                    </form>

                    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary btn-block mt-3">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lịch sử đơn hàng</h3>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <div class="alert alert-info">
                            Khách hàng chưa có đơn hàng nào.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ number_format($order->tong_tien, 0, ',', '.') }}đ</td>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 