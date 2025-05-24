@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm quốc gia mới</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.countries.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="ten_quoc_gia" class="form-label">Tên quốc gia</label>
                    <input type="text" class="form-control @error('ten_quoc_gia') is-invalid @enderror" 
                           id="ten_quoc_gia" name="ten_quoc_gia" value="{{ old('ten_quoc_gia') }}">
                    @error('ten_quoc_gia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection 