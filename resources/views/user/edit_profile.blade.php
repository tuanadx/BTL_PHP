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
                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2"></i> Thông tin tài khoản
                        </a>
                        <a href="{{ route('edit.profile') }}" class="list-group-item list-group-item-action active">
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
                    <h5 class="card-title mb-4">Chỉnh sửa thông tin</h5>
                    
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
                    
                    <form action="{{ route('update.profile') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="ho_ten" class="form-label">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ho_ten') is-invalid @enderror" 
                                id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $user->ho_ten) }}">
                            @error('ho_ten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                            <small class="text-muted">Email không thể thay đổi</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror" 
                                id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}">
                            @error('so_dien_thoai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="dia_chi" class="form-label">Địa chỉ</label>
                            <textarea class="form-control @error('dia_chi') is-invalid @enderror" 
                                id="dia_chi" name="dia_chi" rows="3">{{ old('dia_chi', $user->dia_chi) }}</textarea>
                            @error('dia_chi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="ngay_sinh" class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror" 
                                id="ngay_sinh" name="ngay_sinh" value="{{ old('ngay_sinh', $user->ngay_sinh ? $user->ngay_sinh->format('Y-m-d') : '') }}">
                            @error('ngay_sinh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label d-block">Giới tính</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gioi_tinh" id="nam" value="Nam"
                                    {{ old('gioi_tinh', $user->gioi_tinh) == 'Nam' ? 'checked' : '' }}>
                                <label class="form-check-label" for="nam">Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gioi_tinh" id="nu" value="Nữ"
                                    {{ old('gioi_tinh', $user->gioi_tinh) == 'Nữ' ? 'checked' : '' }}>
                                <label class="form-check-label" for="nu">Nữ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gioi_tinh" id="khac" value="Khác"
                                    {{ old('gioi_tinh', $user->gioi_tinh) == 'Khác' ? 'checked' : '' }}>
                                <label class="form-check-label" for="khac">Khác</label>
                            </div>
                            @error('gioi_tinh')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Lưu thay đổi
                            </button>
                            <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Hủy
                            </a>
                        </div>
                    </form>
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