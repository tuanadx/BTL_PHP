@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chỉnh sửa tác giả</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.authors.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.authors.update', $author->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="ten_tac_gia">Tên tác giả <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ten_tac_gia" name="ten_tac_gia" value="{{ old('ten_tac_gia', $author->ten_tac_gia) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $author->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="sdt">Số điện thoại</label>
                            <input type="text" class="form-control" id="sdt" name="sdt" value="{{ old('sdt', $author->sdt) }}">
                        </div>

                        <div class="form-group">
                            <label for="dia_chi">Địa chỉ</label>
                            <textarea class="form-control" id="dia_chi" name="dia_chi" rows="3">{{ old('dia_chi', $author->dia_chi) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="mo_ta">Mô tả</label>
                            <textarea class="form-control" id="mo_ta" name="mo_ta" rows="5">{{ old('mo_ta', $author->mo_ta) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 