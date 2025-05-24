@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sửa sách</h2>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="ten_sach" class="form-label">Tên sách <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ten_sach') is-invalid @enderror" id="ten_sach" name="ten_sach" value="{{ old('ten_sach', $book->ten_sach) }}" required>
                            @error('ten_sach')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_tac_gia" class="form-label">Tác giả</label>
                                    <select class="form-select @error('id_tac_gia') is-invalid @enderror" id="id_tac_gia" name="id_tac_gia">
                                        <option value="">Chọn tác giả</option>
                                        @foreach($tacGias as $tacGia)
                                        <option value="{{ $tacGia->id }}" {{ old('id_tac_gia', $book->id_tac_gia) == $tacGia->id ? 'selected' : '' }}>
                                            {{ $tacGia->ten_tac_gia }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_tac_gia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ma_nxb" class="form-label">Nhà xuất bản</label>
                                    <select class="form-select @error('ma_nxb') is-invalid @enderror" id="ma_nxb" name="ma_nxb">
                                        <option value="">Chọn nhà xuất bản</option>
                                        @foreach($nhaXuatBans as $nxb)
                                        <option value="{{ $nxb->ma_nxb }}" {{ old('ma_nxb', $book->ma_nxb) == $nxb->ma_nxb ? 'selected' : '' }}>
                                            {{ $nxb->ten_nxb }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ma_nxb')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="ma_quoc_gia" class="form-label">Quốc gia</label>
                            <select class="form-select @error('ma_quoc_gia') is-invalid @enderror" id="ma_quoc_gia" name="ma_quoc_gia">
                                <option value="">Chọn quốc gia</option>
                                @foreach($quocGias as $quocGia)
                                <option value="{{ $quocGia->ma_quoc_gia }}" {{ old('ma_quoc_gia', $book->ma_quoc_gia) == $quocGia->ma_quoc_gia ? 'selected' : '' }}>
                                    {{ $quocGia->ten_quoc_gia }}
                                </option>
                                @endforeach
                            </select>
                            @error('ma_quoc_gia')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gia_tien" class="form-label">Giá tiền <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('gia_tien') is-invalid @enderror" id="gia_tien" name="gia_tien" value="{{ old('gia_tien', $book->gia_tien) }}" required>
                                    @error('gia_tien')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="so_luong" class="form-label">Số lượng <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('so_luong') is-invalid @enderror" id="so_luong" name="so_luong" value="{{ old('so_luong', $book->so_luong) }}" required>
                                    @error('so_luong')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="ngay_phat_hanh" class="form-label">Ngày phát hành</label>
                            <input type="date" class="form-control @error('ngay_phat_hanh') is-invalid @enderror" id="ngay_phat_hanh" name="ngay_phat_hanh" value="{{ old('ngay_phat_hanh', $book->ngay_phat_hanh) }}">
                            @error('ngay_phat_hanh')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gioi_thieu" class="form-label">Giới thiệu</label>
                            <textarea class="form-control @error('gioi_thieu') is-invalid @enderror" id="gioi_thieu" name="gioi_thieu" rows="4">{{ old('gioi_thieu', $book->gioi_thieu) }}</textarea>
                            @error('gioi_thieu')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="anh" class="form-label">Ảnh bìa</label>
                            <input type="file" class="form-control @error('anh') is-invalid @enderror" id="anh" name="anh" accept="image/*">
                            @error('anh')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="preview" class="mt-2">
                            @if($book->anh)
                            <img src="{{ asset('storage/'.$book->anh) }}" alt="{{ $book->ten_sach }}" class="img-thumbnail" style="max-height: 500px;">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Hàm hiển thị preview ảnh
    function displayPreview(src, alt = 'Preview') {
        const preview = document.getElementById('preview');
        preview.innerHTML = `
            <img src="${src}" 
                 alt="${alt}" 
                 class="img-thumbnail" 
                 style="max-height: 300px; width: auto; display: block; margin: 10px 0;">
        `;
    }

    // Hiển thị ảnh khi chọn file
    document.getElementById('anh').addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Kiểm tra xem file có phải là ảnh không
            if (!file.type.startsWith('image/')) {
                alert('Vui lòng chọn file ảnh');
                this.value = '';
                return;
            }

            // Sử dụng FileReader để đọc file
            const reader = new FileReader();
            reader.onload = function(event) {
                displayPreview(event.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            // Nếu không có file được chọn, hiển thị ảnh cũ nếu có
            const oldImage = '{{ $book->anh }}';
            if (oldImage) {
                displayPreview('{{ asset("storage") }}/' + oldImage, '{{ $book->ten_sach }}');
            } else {
                document.getElementById('preview').innerHTML = '';
            }
        }
    });
</script>
@endpush
@endsection 