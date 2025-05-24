@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avatar-placeholder mb-3">
                            <i class="fas fa-user-circle fa-4x text-secondary"></i>
                        </div>
                        <h4 class="mb-0">{{ Auth::guard('khach_hang')->user()->ho_ten }}</h4>
                        <p class="text-muted">Thành viên từ {{ Auth::guard('khach_hang')->user()->ngay_dang_ky ? Auth::guard('khach_hang')->user()->ngay_dang_ky->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                    
                    <div class="list-group">
                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2"></i> Thông tin tài khoản
                        </a>
                        <a href="{{ route('edit.profile') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit me-2"></i> Chỉnh sửa thông tin
                        </a>
                        <a href="{{ route('change.password') }}" class="list-group-item list-group-item-action active">
                            <i class="fas fa-key me-2"></i> Đổi mật khẩu
                        </a>
                        <a href="{{ route('order.list') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-history me-2"></i> Lịch sử đơn hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Change Form -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Đổi mật khẩu</h5>

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

                    <form action="{{ route('update.password') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                    id="current_password" name="current_password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                    id="new_password" name="new_password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="confirm_new_password" class="form-label">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('confirm_new_password') is-invalid @enderror" 
                                    id="confirm_new_password" name="confirm_new_password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_new_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('confirm_new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
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

.invalid-feedback {
    display: block;
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush 