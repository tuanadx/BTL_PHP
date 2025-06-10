@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách sách</h2>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm sách mới
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Tên sách</th>
                            <th>Tác giả</th>
                            <th>Nhà xuất bản</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>
                                @if($book->anh)
                                    <img src="{{ asset('storage/books/' . basename($book->anh)) }}" alt="{{ $book->ten_sach }}" style="max-width: 50px;">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td>{{ $book->ten_sach }}</td>
                            <td>{{ $book->tacGia->ten_tac_gia ?? 'Không có' }}</td>
                            <td>{{ $book->nhaXuatBan->ten_nxb ?? 'Không có' }}</td>
                            <td>{{ number_format($book->gia_tien) }} VNĐ</td>
                            <td>{{ $book->so_luong }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa sách này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 