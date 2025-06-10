@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Kết quả tìm kiếm:</h2>

    @if($books->count())
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($books as $book)
            <div class="col">
                <div class="card search-card h-100">
                    <img src="{{ $book->anh ? asset('storage/books/' . basename($book->anh)) : asset('images/default-book.jpg') }}" class="card-img-top" alt="{{ $book->ten_sach }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->ten_sach }}</h5>
                        <p class="card-text mb-1"><strong>Tác giả:</strong> {{ $book->tacGia->ten_tac_gia ?? 'N/A' }}</p>
                        <p class="card-text mb-1"><strong>Nhà xuất bản:</strong> {{ $book->nhaXuatBan->ten_nxb ?? 'N/A' }}</p>
                        <p class="card-text"><strong>Giá:</strong> {{ number_format($book->gia_tien, 0, ',', '.') }}₫</p>
                        <a href="{{ route('books.detail', $book->id) }}" class="btn btn-success btn-sm mt-2">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4 search-pagination">
            {{ $books->links() }}
        </div>
    @else
        <div class="alert alert-warning">Không tìm thấy kết quả phù hợp.</div>
    @endif
</div>
@endsection
