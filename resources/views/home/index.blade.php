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


<title>Section 1 - Sự kiện & Tin tức</title>
  <title>Section 1 - Tin Tức Nhã Nam</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f9f4;
    }

    .section-news {
      padding: 40px 20px;
      max-width: 1200px;
      margin: auto;
    }

    .container-news {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
    }

    /* Slider bên trái */
    .news-slider {
      flex: 2;
      min-width: 300px;
      position: relative;
      overflow: hidden;
    }

    .slides {
      display: flex;
      transition: transform 0.5s ease-in-out;
      width: 300%;
    }

    .slide {
      width: 100%;
      flex-shrink: 0;
      position: relative;
    }

    .slide img {
      width: 750px;
      height: auto;
      border-radius: 8px;
      display: block;
    }

    .slide-info {
      background: white;
      padding: 15px 20px;
      margin-top: -4px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .slide-info h3 {
      margin: 0;
      font-size: 20px;
      color: #1a1a1a;
    }

    .slide-info p {
      font-size: 14px;
      color: #888;
      margin-top: 6px;
    }

    /* Danh sách bài viết bên phải */
    .news-list {
      flex: 1;
      min-width: 280px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .news-item {
      display: flex;
      gap: 15px;
      background: #fff;
      padding: 12px;
      border-radius: 6px;
      box-shadow: 0 1px 5px rgba(0,0,0,0.05);
      text-decoration: none;
      transition: background 0.3s;
    }

    .news-item:hover {
      background-color: #d0f3ec;
    }

    .news-item img {
      width: 90px;
      height: 70px;
      object-fit: cover;
      border-radius: 4px;
    }

    .news-item h4 {
      font-size: 15px;
      margin: 0;
      color: #1c1c1c;
    }

    .news-item p {
      font-size: 13px;
      color: #777;
      margin-top: 5px;
    }

    @media (max-width: 768px) {
      .container-news {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
<section class="section-news">
    <div class="container-news">

      <!-- Slider trái -->
      <div class="news-slider">
        <div class="slides" id="slides">
          <!-- Slide 1 -->
          <div class="slide">
            <a href="baibao1.html">
            <img src="image/1.webp" alt="">
            <div class="slide-info">
              <h3>HỘI SÁCH NHÃ NAM CHÀO HÈ 2025</h3>
              <p>Thứ Ba, 08/04/2025</p>
            </div>
          </div>
          <!-- Slide 2 -->
          <div class="slide">
            <a href="baibao2.html">
            <img src="image/2.webp" alt="">
            <div class="slide-info">
              <h3>SỰ KIỆN ĐẶC BIỆT NHÃ NAM 2025</h3>
              <p>Thứ Sáu, 12/04/2025</p>
            </div>
          </div>
          <!-- Slide 3 -->
          <div class="slide">
            <a href="baibao3.html">
            <img src="image/3.webp" alt="">
            <div class="slide-info">
              <h3>HỘI THẢO GIỚI THIỆU SÁCH MỚI</h3>
              <p>Thứ Bảy, 20/04/2025</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Bài viết phải -->
      <div class="news-list">
        <a class="news-item" href="baibao4.html">
          <img src="image/4.webp" alt="">
          <div>
            <h4>Hành trình khám phá sự phát triển của nghệ thuật âm thanh qua các</h4>
            <p>Thứ Hai, 17/03/2025</p>
          </div>
        </a>
        <a class="news-item" href="baibao5.html">
          <img src="image/5.webp" alt="">
          <div>
            <h4>Con người và đất đai</h4>
            <p>Thứ Hai, 17/03/2025</p>
          </div>
        </a>
        <a class="news-item" href="baibao6.html">
          <img src="image/6.webp" alt="">
          <div>
            <h4>“Pha cà phê ngon tại nhà” - Cẩm nang toàn diện để pha cà phê</h4>
            <p>Chủ Nhật, 16/02/2025</p>
          </div>
        </a>
        <a class="news-item" href="baibao7.html">
          <img src="image/7.webp" alt="">
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
    const totalSlides = slides.children.length;

    setInterval(() => {
      index = (index + 1) % totalSlides;
      slides.style.transform = `translateX(-${index * 100}%)`;
    }, 4000);
  </script>

</body>










  <title>Các tác giả</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
      margin: 0;
      padding: 0;
    }

    .section-authors {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 16px;
    }

    .section-authors h2 {
      font-size: 24px;
      font-weight: bold;
      color: #207c2e;
      border-bottom: 2px solid #207c2e;
      display: inline-block;
      margin-bottom: 20px;
    }

    .view-more {
      float: right;
      font-size: 14px;
      color: #207c2e;
      text-decoration: none;
      margin-top: 8px;
    }

    .view-more i {
      margin-left: 4px;
    }

    .swiper-slide {
      text-align: center;
      padding: 10px;
    }

    .author-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 8px;
      background-color: #e3e5e6;
    }

    .author-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .author-name {
      font-size: 15px;
      color: #333;
      font-weight: 500;
    }
  </style>
<body>

<div class="section-authors">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Các tác giả</h2>
    <a href="#" class="view-more">Xem thêm <i class="fas fa-arrow-right"></i></a>
  </div>

  <div class="swiper mySwiperTacgia">
    <div class="swiper-wrapper">

      <!-- Tác giả 1 -->
      <div class="swiper-slide">
        <div class="author-avatar">
          <img src="image/tgia/1&2.webp" alt="Kolya Bùi">
        </div>
        <div class="author-name">Kolya Bùi</div>
      </div>

      <!-- Tác giả 2 -->
      <div class="swiper-slide">
        <div class="author-avatar">
          <img src="image/tgia/1&2.webp" alt="Ngọ Diệp">
        </div>
        <div class="author-name">Ngọ Diệp</div>
      </div>

      <!-- Tác giả 3 -->
      <div class="swiper-slide">
        <div class="author-avatar">
          <img src="image/tgia/3.webp" alt="Timothy Corrigan">
        </div>
        <div class="author-name">Timothy Corrigan</div>
      </div>

      <!-- Tác giả 4 -->
      <div class="swiper-slide">
        <div class="author-avatar">
          <img src="image/tgia/4.webp" alt="Wu Ming-Yi">
        </div>
        <div class="author-name">Wu Ming-Yi</div>
      </div>

      <!-- Tác giả 5 -->
      <div class="swiper-slide">
        <div class="author-avatar">
          <img src="image/tgia/5.webp" alt="Maxime Pérez">
        </div>
        <div class="author-name">Maxime Pérez</div>
      </div>

      <!-- Tác giả 6 -->
      <div class="swiper-slide">
        <div class="author-avatar">
          <img src="image/tgia/6.webp" alt="James West">
        </div>
        <div class="author-name">James West</div>
      </div>

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