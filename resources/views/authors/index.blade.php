@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Tác giả</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h1 class="title-module">Tác giả</h1>
                    
                    <div class="row" id="author-grid">
                        @foreach($authors as $author)
                        <div class="col-md-4 col-6 col-lg-3 col-xl-3">
                            <article class="item_author_base">
                                <a class="thumb image_thumb" href="{{ route('authors.show', $author->id) }}" title="{{ $author->ten_tac_gia }}">
                                    <img width="150" height="150" src="https://bizweb.dktcdn.net/100/363/455/articles/blank-profile-picture-973460-640-084e4e29-55b0-4110-a202-e789fff36a77.png" alt="{{ $author->ten_tac_gia }}" class="img-responsive">
                                </a>
                                <h3><a href="{{ route('authors.show', $author->id) }}" title="{{ $author->ten_tac_gia }}" class="a-title">{{ $author->ten_tac_gia }}</a></h3>
                            </article>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div id="pagination" class="pagination">
                        {{ $authors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
    $(document).ready(function() {
        // Xử lý khi click vào phân trang
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            
            // Hiển thị loading
            Swal.fire({
                title: 'Đang tải...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Lấy URL của trang cần tải
            var page = $(this).attr('href').split('page=')[1];
            
            // Gọi AJAX để lấy dữ liệu
            $.ajax({
                url: '{{ route("authors.index") }}',
                type: 'GET',
                data: {
                    page: page
                },
                success: function(response) {
                    // Parse HTML response
                    var html = $(response);
                    
                    // Cập nhật grid tác giả
                    $('#author-grid').html(html.find('#author-grid').html());
                    
                    // Cập nhật phân trang
                    $('#pagination').html(html.find('#pagination').html());

                    // Đóng loading
                    Swal.close();

                    // Cập nhật URL
                    var newUrl = window.location.origin + window.location.pathname + '?page=' + page;
                    window.history.pushState({}, '', newUrl);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Đã có lỗi xảy ra khi tải trang'
                    });
                }
            });
        });
    });
    </script>
@endsection 