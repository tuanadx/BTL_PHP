@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm nhà xuất bản mới</h1>
        <a href="{{ route('admin.publishers.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.publishers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="ten_nxb">Tên nhà xuất bản <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('ten_nxb') is-invalid @enderror" 
                           id="ten_nxb" name="ten_nxb" value="{{ old('ten_nxb') }}" required>
                    @error('ten_nxb')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('sdt') is-invalid @enderror" 
                           id="sdt" name="sdt" value="{{ old('sdt') }}" required>
                    @error('sdt')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dia_chi">Địa chỉ <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('dia_chi') is-invalid @enderror" 
                              id="dia_chi" name="dia_chi" rows="3" required>{{ old('dia_chi') }}</textarea>
                    @error('dia_chi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu nhà xuất bản
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 