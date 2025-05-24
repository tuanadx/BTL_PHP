@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa khách hàng</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.customers.update', $customer->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="ho_ten" class="form-label">Họ tên</label>
                    <input type="text" class="form-control @error('ho_ten') is-invalid @enderror" 
                           id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $customer->ho_ten) }}">
                    @error('ho_ten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $customer->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror" 
                           id="so_dien_thoai" name="so_dien_thoai" 
                           value="{{ old('so_dien_thoai', $customer->so_dien_thoai) }}">
                    @error('so_dien_thoai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dia_chi" class="form-label">Địa chỉ</label>
                    <textarea class="form-control @error('dia_chi') is-invalid @enderror" 
                              id="dia_chi" name="dia_chi" rows="3">{{ old('dia_chi', $customer->dia_chi) }}</textarea>
                    @error('dia_chi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection 