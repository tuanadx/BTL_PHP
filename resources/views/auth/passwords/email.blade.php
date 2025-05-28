@extends('layouts.app') <!-- hoặc layout bạn đang dùng -->

@section('content')
<div class="container mt-5">
    <h2>Quên mật khẩu</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Địa chỉ Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Gửi liên kết đặt lại mật khẩu</button>
    </form>
</div>
@endsection
