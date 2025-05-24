@include('includes.header')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="active">Tất cả sản phẩm</li>
        </ul>
    </div>
</div>

<!-- Banner -->
<div class="banner">
    <div class="container">
        <img src="https://ext.same-assets.com/3715259319/2232221781.jpeg" alt="Banner">
    </div>
</div>

<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <div class="sidebar">
            <div class="filter-block">
                <h2>Quốc gia</h2>
                <form id="countryFilterForm" action="{{ url('/') }}" method="get">
                    <div class="filter-options">
                        @foreach($countries as $country)
                            <label class="checkbox-container">
                                <input type="checkbox" name="country[]" 
                                       value="{{ $country->ma_quoc_gia }}"
                                       {{ in_array($country->ma_quoc_gia, $selectedCountries) ? 'checked' : '' }}
                                       class="country-filter">
                                <span class="checkmark"></span>
                                {{ $country->ten_quoc_gia }}
                            </label>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
        <div class="product-content">
            <div class="collection-header" id="product-section">
                <h1>{{ $title }}</h1>
                <div class="collection-sorting">
                    <span>Sắp xếp theo</span>
                    <div class="sort-options">
                        <a href="#" data-sort="" class="sort-option {{ !isset($sortType) || empty($sortType) ? 'active' : '' }}">Mặc định</a>
                        <a href="#" data-sort="newest" class="sort-option {{ $sortType == 'newest' ? 'active' : '' }}">Sách mới</a>
                        <a href="#" data-sort="price-asc" class="sort-option {{ $sortType == 'price-asc' ? 'active' : '' }}">Giá thấp - cao</a>
                        <a href="#" data-sort="price-desc" class="sort-option {{ $sortType == 'price-desc' ? 'active' : '' }}">Giá cao - thấp</a>
                    </div>
                </div>
            </div>
            
            <div id="product-grid" class="product-grid">
                @if ($books->count())
                    @foreach ($books as $book)
                        <div class="product-item">
                            <div class="product-image">
                                <a href="{{ url('/books/detail/' . $book->id) }}">
                                    <img src="{{ !empty($book->anh) ? asset('storage/' . $book->anh) : asset('images/default-book.jpg') }}" alt="{{ $book->ten_sach }}">
                                </a>
                            </div>
                            <div class="product-info">
                                <h3><a href="{{ url('/books/detail/' . $book->id) }}">{{ $book->ten_sach }}</a></h3>
                                <div class="product-price">
                                    <span class="current-price">{{ number_format($book->gia_tien) }}đ</span>
                                </div>
                            </div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-book-id="{{ $book->id }}"><i class="fas fa-shopping-cart"></i></button>
                                <button class="buy-now" data-book-id="{{ $book->id }}">Mua ngay</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Không có sản phẩm nào.</p>
                @endif
            </div>

            <!-- Pagination -->
            <div id="pagination" class="pagination">
                {{ $books->appends(['sort' => $sortType, 'country' => $selectedCountries])->links() }}
            </div>
        </div>
    </div>
</main>

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<script>
$(document).ready(function() {
    // Xử lý khi checkbox thay đổi
    $('.country-filter').change(function() {
        filterProducts();
    });

    // Xử lý khi click vào option sắp xếp
    $('.sort-option').click(function(e) {
        e.preventDefault();
        $('.sort-option').removeClass('active');
        $(this).addClass('active');
        filterProducts();
    });

    // Hàm lọc sản phẩm
    function filterProducts() {
        // Lấy danh sách quốc gia được chọn
        var selectedCountries = [];
        $('.country-filter:checked').each(function() {
            selectedCountries.push($(this).val());
        });

        // Lấy kiểu sắp xếp
        var sortType = $('.sort-option.active').data('sort');

        // Hiển thị loading
        Swal.fire({
            title: 'Đang tải...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Gọi AJAX để lấy dữ liệu
        $.ajax({
            url: '{{ url("/") }}',
            type: 'GET',
            data: {
                country: selectedCountries,
                sort: sortType
            },
            success: function(response) {
                // Parse HTML response
                var html = $(response);
                
                // Cập nhật grid sản phẩm
                $('#product-grid').html(html.find('#product-grid').html());
                
                // Cập nhật phân trang
                $('#pagination').html(html.find('#pagination').html());

                // Đóng loading
                Swal.close();

                // Cập nhật URL để có thể share
                var params = {};
                if (selectedCountries.length > 0) {
                    params.country = selectedCountries;
                }
                if (sortType) {
                    params.sort = sortType;
                }
                var newUrl = window.location.origin + window.location.pathname;
                if (Object.keys(params).length > 0) {
                    newUrl += '?' + $.param(params);
                }
                window.history.pushState({}, '', newUrl);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Đã có lỗi xảy ra khi lọc sản phẩm'
                });
            }
        });
    }
});
</script>

@include('includes.footer')