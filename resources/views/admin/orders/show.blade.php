@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết đơn hàng #{{ $order->id }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5>Thông tin khách hàng</h5>
                            <p><strong>Họ tên:</strong> {{ $order->khachHang->ho_ten }}</p>
                            <p><strong>Email:</strong> {{ $order->khachHang->email }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $order->khachHang->so_dien_thoai }}</p>
                            <p><strong>Địa chỉ:</strong> {{ $order->khachHang->dia_chi }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h5>Thông tin đơn hàng</h5>
                            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            @if($order->ghi_chu)
                                <p><strong>Ghi chú:</strong> {{ $order->ghi_chu }}</p>
                            @endif
                        </div>
                    </div>

                    <h5>Chi tiết sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->chiTietDonHang as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->sach->anh)
                                                <img src="{{ asset('storage/' . $item->sach->anh) }}" 
                                                     alt="{{ $item->sach->ten_sach }}" 
                                                     class="img-thumbnail mr-3" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                            <span>{{ $item->sach->ten_sach }}</span>
                                        </div>
                                    </td>
                                    <td>{{ number_format($item->don_gia, 0, ',', '.') }}đ</td>
                                    <td>{{ $item->so_luong }}</td>
                                    <td>{{ number_format($item->thanh_tien, 0, ',', '.') }}đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Tổng tiền:</strong></td>
                                    <td><strong>{{ number_format($order->tong_tien, 0, ',', '.') }}đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật trạng thái</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="trang_thai">Trạng thái đơn hàng</label>
                            <select name="trang_thai" id="trang_thai" class="form-control @error('trang_thai') is-invalid @enderror">
                                <option value="cho_xu_ly" {{ $order->trang_thai === 'cho_xu_ly' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="dang_giao" {{ $order->trang_thai === 'dang_giao' ? 'selected' : '' }}>Đang giao hàng</option>
                                <option value="da_giao" {{ $order->trang_thai === 'da_giao' ? 'selected' : '' }}>Đã giao hàng</option>
                                <option value="da_huy" {{ $order->trang_thai === 'da_huy' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            @error('trang_thai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Cập nhật trạng thái
                        </button>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-arrow-left"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 