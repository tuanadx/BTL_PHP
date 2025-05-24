<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng ký tài khoản - Nhà sách online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    @include('includes.header')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <h2 class="text-center mb-4">Đăng ký tài khoản</h2>
                        
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="ho_ten" class="form-label">Họ tên <span class="text-danger">*</span></label>
                                <input type="text" name="ho_ten" id="ho_ten" 
                                    class="form-control form-control-lg @error('ho_ten') is-invalid @enderror" 
                                    value="{{ old('ho_ten') }}">
                                @error('ho_ten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" 
                                    class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                <input type="text" name="so_dien_thoai" id="so_dien_thoai" 
                                    class="form-control form-control-lg @error('so_dien_thoai') is-invalid @enderror" 
                                    value="{{ old('so_dien_thoai') }}">
                                @error('so_dien_thoai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" 
                                    class="form-control form-control-lg @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                    class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="dia_chi" class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                <textarea name="dia_chi" id="dia_chi" 
                                    class="form-control form-control-lg @error('dia_chi') is-invalid @enderror" 
                                    rows="3">{{ old('dia_chi') }}</textarea>
                                @error('dia_chi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg" style="background-color: #2a5a4c; border-color: #2a5a4c;">Đăng ký</button>
                            </div>
                            
                            <div class="text-center mt-4">
                                <p>Đã có tài khoản? <a href="{{ route('login') }}" class="text-decoration-none">Đăng nhập</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- App JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html> 