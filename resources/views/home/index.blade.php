@include('includes.header')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/home-sections.css') }}">

<!-- Breadcrumb -->
<!-- <div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="active">Tất cả sản phẩm</li>
        </ul>
    </div>
</div> -->

<title>Section 1 - Sự kiện & Tin tức</title>
<title>Section 1 - Tin Tức Nhã Nam</title>

<div class="section-title-container">
    <h2 class="section-title">Tin tức & Sự kiện</h2>
</div>

<section class="section-news">
    <div class="container-news">
      <!-- Slider trái -->
      <div class="news-slider">
        <div class="slides" id="slides">
          <!-- Slide 1 -->
          <div class="slide">
            <a href="{{ route('news.nhanam') }}">
            <img src="https://bizweb.dktcdn.net/100/363/455/articles/494621307-1097261965774870-6550418258675179038-n.jpg?v=1746519986820" alt="">
            <div class="slide-info">
              <h3>HỘI SÁCH NHÃ NAM CHÀO HÈ 2025</h3>
              <p>Thứ Ba, 08/04/2025</p>
            </div>
          </div>
          <!-- Slide 2 -->
          <div class="slide">
            <a href="{{ route('news.nhanam') }}">
            <img src="https://bizweb.dktcdn.net/100/363/455/articles/491279363-1088490436652023-2743767814237791180-n.jpg?v=1745208865993" alt="">
            <div class="slide-info">
              <h3>SỰ KIỆN ĐẶC BIỆT NHÃ NAM 2025</h3>
              <p>Thứ Sáu, 12/04/2025</p>
            </div>
          </div>
          <!-- Slide 3 -->
          <div class="slide">
            <a href="{{ route('news.nhanam') }}">
            <img src="https://bizweb.dktcdn.net/100/363/455/articles/489006758-1079586880875712-661463280947496865-n.jpg?v=1744100699603" alt="">
            <div class="slide-info">
              <h3>HỘI THẢO GIỚI THIỆU SÁCH MỚI</h3>
              <p>Thứ Bảy, 20/04/2025</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Bài viết phải -->
      <div class="news-list">
        <a class="news-item" href="{{ route('news.nhanam') }}">
          <img src="https://bizweb.dktcdn.net/100/363/455/articles/484799317-1063744625793271-7677298375345374751-n.jpg?v=1742792125167" alt="">
          <div>
            <h4>Hành trình khám phá sự phát triển của nghệ thuật âm thanh qua các</h4>
            <p>Thứ Hai, 17/03/2025</p>
          </div>
        </a>
        <a class="news-item" href="{{ route('news.nhanam') }}">
          <img src="https://bizweb.dktcdn.net/100/363/455/articles/website-a-nh-da-i-die-n-ba-i-vie-t-17-51a80241-426c-4785-b5e1-9aedf8dff8c0.png?v=1742197752157" alt="">
          <div>
            <h4>Con người và đất đai</h4>
            <p>Thứ Hai, 17/03/2025</p>
          </div>
        </a>
        <a class="news-item" href="{{ route('news.nhanam') }}">
          <img src="https://bizweb.dktcdn.net/100/363/455/articles/480203269-1042894241211643-9180551152830458713-n.jpg?v=1740994652690" alt="">
          <div>
            <h4>"Pha cà phê ngon tại nhà" - Cẩm nang toàn diện để pha cà phê</h4>
            <p>Chủ Nhật, 16/02/2025</p>
          </div>
        </a>
        <a class="news-item" href="{{ route('news.nhanam') }}">
          <img src="https://bizweb.dktcdn.net/100/363/455/articles/website-a-nh-da-i-die-n-ba-i-vie-t-14-42424747-4313-46a1-a9d9-0375b3214194.png?v=1740891085440" alt="">
          <div>
            <h4>MAUS - làm thế nào để nói về Holocaust?</h4>
            <p>Thứ Hai, 20/01/2025</p>
          </div>
        </a>
      </div>
    </div>
</section>

<!-- Script chạy slider -->
<script>
    let index = 0;
    const slides = document.getElementById('slides');

    // Clone slide đầu tiên và thêm vào cuối
    const firstSlide = slides.children[0].cloneNode(true);
    slides.appendChild(firstSlide);

    const totalSlides = slides.children.length - 1;

    function nextSlide() {
        index++;
        slides.style.transition = 'transform 0.5s ease-in-out';
        slides.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(nextSlide, 3000);

    slides.addEventListener('transitionend', () => {
        if (index === totalSlides) {
            slides.style.transition = 'none';
            index = 0;
            slides.style.transform = `translateX(0)`;
            setTimeout(() => {
                slides.style.transition = 'transform 0.5s ease-in-out';
            }, 50);
        }
    });
</script>



<title>Các tác giả</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="section-authors">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h2 class="section-title">Các tác giả</h2>
    <a href="{{ route('authors.index') }}" class="view-more">Xem thêm <i class="fas fa-arrow-right"></i></a>
  </div>

  <div class="swiper mySwiperTacgia">
    <div class="swiper-wrapper">
      @foreach($authors as $author)
      <div class="swiper-slide">
        <div class="author-avatar">
          <img width="150" height="150" src="https://bizweb.dktcdn.net/100/363/455/articles/blank-profile-picture-973460-640-084e4e29-55b0-4110-a202-e789fff36a77.png" alt="{{ $author->ten_tac_gia }}" class="img-responsive">
        </div>
        <div class="author-name">{{ $author->ten_tac_gia }}</div>
      </div>
      @endforeach
    </div>

    <!-- Nút điều hướng -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const mySwiperTacgia = new Swiper(".mySwiperTacgia", {
    slidesPerView: 4,
    spaceBetween: 20,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: { slidesPerView: 2 },
      640: { slidesPerView: 3 },
      768: { slidesPerView: 4 },
      1024: { slidesPerView: 5 }
    }
  });
</script>

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
                <h1 class="section-title">{{ $title }}</h1>
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

    // Xử lý nút thêm vào giỏ hàng
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        const bookId = $(this).data('book-id');
        addToCart(bookId, 1, false);
    });

    // Xử lý nút mua ngay
    $('.buy-now').click(function(e) {
        e.preventDefault();
        const bookId = $(this).data('book-id');
        buyNow(bookId, 1);
    });

    // Hàm mua ngay
    async function buyNow(bookId, quantity) {
        try {
            // Hiển thị loading
            Swal.fire({
                title: 'Đang xử lý...',
                text: 'Vui lòng đợi trong giây lát',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Gửi request thêm vào giỏ hàng với flag buy_now
            const response = await fetch('{{ url("/cart/add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    book_id: bookId,
                    quantity: quantity,
                    buy_now: 1
                })
            });

            const data = await response.json();

            if (data.success) {
                // Cập nhật số lượng trong giỏ hàng
                const cartCountElement = document.querySelector('.cart-count');
                if (cartCountElement && data.cartCount) {
                    cartCountElement.textContent = data.cartCount;
                    cartCountElement.style.display = 'block';
                }
                
                // Chuyển đến trang checkout
                window.location.href = '{{ url("/cart/checkout") }}';
            } else {
                throw new Error(data.message || 'Không thể thêm sản phẩm vào giỏ hàng');
            }
        } catch (error) {
            console.error('Lỗi:', error);
            Swal.fire({
                title: 'Có lỗi xảy ra!',
                text: error.message || 'Không thể thêm sản phẩm vào giỏ hàng',
                icon: 'error',
                confirmButtonText: 'Đóng',
                confirmButtonColor: '#2a5a4c'
            });
        }
    }

    // Hàm thêm vào giỏ hàng
    async function addToCart(bookId, quantity, redirectToCart = false) {
        try {
            // Hiển thị loading
            Swal.fire({
                title: 'Đang xử lý...',
                text: 'Vui lòng đợi trong giây lát',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Gửi request thêm vào giỏ hàng
            const response = await fetch('{{ url("/cart/add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    book_id: bookId,
                    quantity: quantity
                })
            });

            const data = await response.json();

            if (data.success) {
                // Cập nhật số lượng trong giỏ hàng
                const cartCountElement = document.querySelector('.cart-count');
                if (cartCountElement && data.cartCount) {
                    cartCountElement.textContent = data.cartCount;
                    cartCountElement.style.display = 'block';
                }

                // Hiển thị thông báo thành công
                const bookTitle = $(`.product-item button[data-book-id="${bookId}"]`)
                    .closest('.product-item')
                    .find('.product-info h3 a')
                    .text();

                Swal.fire({
                    title: 'Thành công!',
                    text: `Đã thêm "${bookTitle}" vào giỏ hàng`,
                    icon: 'success',
                    confirmButtonText: 'Xem giỏ hàng',
                    showCancelButton: true,
                    cancelButtonText: 'Tiếp tục mua sắm',
                    confirmButtonColor: '#2a5a4c',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ url("/cart") }}';
                    }
                });
            } else {
                throw new Error(data.message || 'Không thể thêm sản phẩm vào giỏ hàng');
            }
        } catch (error) {
            console.error('Lỗi:', error);
            Swal.fire({
                title: 'Có lỗi xảy ra!',
                text: error.message || 'Không thể thêm sản phẩm vào giỏ hàng',
                icon: 'error',
                confirmButtonText: 'Đóng',
                confirmButtonColor: '#2a5a4c'
            });
        }
    }

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