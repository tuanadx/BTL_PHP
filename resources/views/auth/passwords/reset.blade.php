@extends('layouts.app') <!-- hoặc layout bạn đang dùng -->

@section('content')
<div class="container mt-5">
    <h2>Đặt lại mật khẩu</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">Địa chỉ Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ $email ?? old('email') }}" required autofocus>

            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
             <div class="input-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()" tabindex="-1">
                    <i class="fa fa-eye" id="toggleIcon"></i>
                </button>
            </div>  
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">Xác nhận mật khẩu</label>
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success">Đặt lại mật khẩu</button>
    </form>
</div>
@endsection

<SCRIPT>
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