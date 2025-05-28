<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng nhập - Nhà sách online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    @include('includes.header')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Đăng nhập</h2>
                        
                        <form id="loginForm" action="{{ route('login') }}" method="POST">
                            @csrf
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
                            <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()" tabindex="-1">
                                    <i class="fa fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="captcha">Mã xác nhận</label>
                                <div class="d-flex align-items-center">
                                    <img src="{{ captcha_src('default') }}" id="captcha-img" alt="captcha" class="ms-2" style="height: 45px; cursor: pointer;" title="Click để đổi mã">
                                    <button type="button" class="btn btn-secondary btn-sm ms-2" id="reload">🔄</button>
                                </div>
                                <input type="text" class="form-control mt-2" name="captcha" placeholder="Nhập mã xác nhận">
                                @if ($errors->has('captcha'))
                                    <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                @endif
                            </div>        
                                
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg" style="background-color: #2a5a4c; border-color: #2a5a4c;">Đăng nhập</button>
                            </div>
                            
                            <div class="text-center mt-4">
                                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                <p>Chưa có tài khoản? <a href="{{ route('register') }}" class="text-decoration-none">Đăng ký</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <!-- Cart Script -->
    <script src="{{ asset('js/utils.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $('#reload').click(function () {
    $('#captcha-img').attr('src', '{{ captcha_src('default') }}' + '?' + Date.now());
});
    $(document).ready(function() {
        setupAjaxDefaults();
        
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        // Hiển thị thông báo thành công
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: 'Đăng nhập thành công',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Đồng bộ giỏ hàng nếu cần
                            if (typeof syncLocalCart === 'function') {
                                syncLocalCart().then(() => {
                                    window.location.href = response.redirect || '/';
                                });
                            } else {
                                window.location.href = response.redirect || '/';
                            }
                        });
                    } else {
                        // Hiển thị lỗi
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: response.message || 'Email hoặc mật khẩu không chính xác'
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Có lỗi xảy ra khi đăng nhập';
                    
                    // Xử lý lỗi validation
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors)[0][0];
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: errorMessage
                    });
                }
            });
        });
    });
    function togglePassword() {
                            const input = document.getElementById("password");
                            const icon = document.getElementById("toggleIcon");
                            if (input.type === "password") {
                                input.type = "text";
                                icon.classList.remove("fa-eye");
                                icon.classList.add("fa-eye-slash");
                            } else {
                                input.type = "password";
                                icon.classList.remove("fa-eye-slash");
                                icon.classList.add("fa-eye");
                            }
    }   
    </script>
</body>
</html> 
