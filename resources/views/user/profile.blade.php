@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avatar-placeholder mb-3">
                            <i class="fas fa-user-circle fa-4x text-secondary"></i>
                        </div>
                        <h4 class="mb-0">{{ $user->ho_ten }}</h4>
                        <p class="text-muted">Thành viên từ {{ $user->ngay_dang_ky ? $user->ngay_dang_ky->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                    
                    <div class="list-group">
                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action active">
                            <i class="fas fa-user me-2"></i> Thông tin tài khoản
                        </a>
                        <a href="{{ route('edit.profile') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit me-2"></i> Chỉnh sửa thông tin
                        </a>
                        <a href="{{ route('change.password') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-key me-2"></i> Đổi mật khẩu
                        </a>
                        <a href="{{ route('order.list') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-history me-2"></i> Lịch sử đơn hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Thông tin tài khoản</h5>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Họ tên:</div>
                        <div class="col-md-8">{{ $user->ho_ten }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Email:</div>
                        <div class="col-md-8">{{ $user->email }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Số điện thoại:</div>
                        <div class="col-md-8">{{ $user->so_dien_thoai ?: 'Chưa cập nhật' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Địa chỉ:</div>
                        <div class="col-md-8">{{ $user->dia_chi ?: 'Chưa cập nhật' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Ngày sinh:</div>
                        <div class="col-md-8">{{ $user->ngay_sinh ? $user->ngay_sinh->format('d/m/Y') : 'Chưa cập nhật' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Giới tính:</div>
                        <div class="col-md-8">{{ $user->gioi_tinh ?: 'Chưa cập nhật' }}</div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('edit.profile') }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Chỉnh sửa thông tin
                        </a>
                        <a href="{{ route('change.password') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-key me-2"></i>Đổi mật khẩu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar-placeholder {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border-radius: 50%;
}

.list-group-item {
    border: none;
    padding: 0.75rem 1rem;
    color: #495057;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    color: #2a5a4c;
}

.list-group-item.active {
    background-color: #2a5a4c;
    border-color: #2a5a4c;
}

.list-group-item i {
    width: 20px;
    text-align: center;
}

.btn-primary {
    background-color: #2a5a4c;
    border-color: #2a5a4c;
}

.btn-primary:hover {
    background-color: #1a3a2c;
    border-color: #1a3a2c;
}
</style>
@endpush 