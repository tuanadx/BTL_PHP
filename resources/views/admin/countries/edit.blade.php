@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa quốc gia</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.countries.update', $country->ma_quoc_gia) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="ma_quoc_gia" class="form-label">Mã quốc gia</label>
                    <input type="text" class="form-control" id="ma_quoc_gia" value="{{ $country->ma_quoc_gia }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="ten_quoc_gia" class="form-label">Tên quốc gia</label>
                    <input type="text" class="form-control @error('ten_quoc_gia') is-invalid @enderror" 
                           id="ten_quoc_gia" name="ten_quoc_gia" value="{{ old('ten_quoc_gia', $country->ten_quoc_gia) }}">
                    @error('ten_quoc_gia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection 