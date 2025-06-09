@extends('layouts.app')

@section('content')
<div class="book-detail-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li><a href="{{ url('/books') }}">Sách</a></li>
                <li class="active">{{ $book->ten_sach }}</li>
            </ul>
        </div>
    </div>

    <!-- Book Detail Section -->
    <section class="book-detail">
        <div class="container">
            <div class="book-wrapper">
                <div class="book-image-container">
                    <div class="main-image">
                        <img src="{{ !empty($book->anh) ? asset('storage/' . $book->anh) : asset('images/default-book.jpg') }}" 
                             alt="{{ $book->ten_sach }}" class="img-fluid">
                    </div>
                </div>
                
                <div class="book-info">
                    <div class="book-header">
                        <h1 class="book-title">{{ $book->ten_sach }}</h1>
                        <div class="book-meta">
                            <div class="meta-row">
                                <p class="book-author">
                                    <span class="label">Tác giả:</span> 
                                    <span class="value">{{ $book->tacGia->ten_tac_gia }}</span>
                                </p>
                                <div class="stock-status">
                                    @if($book->so_luong > 0)
                                        <span class="in-stock"><i class="fas fa-check-circle"></i> Còn hàng</span>
                                    @else
                                        <span class="out-of-stock"><i class="fas fa-times-circle"></i> Hết hàng</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="book-pricing">
                        <div class="price-wrapper">
                            <span class="current-price">{{ number_format($book->gia_tien, 0, ',', '.') }}₫</span>
                        </div>
                    </div>
                    
                    <div class="book-actions">
                        <div class="quantity-selector">
                            <span class="label">Số lượng:</span>
                            <div class="quantity-input">
                                <button type="button" class="quantity-btn minus">-</button>
                                <input type="number" id="quantity" name="quantity" min="1" max="{{ $book->so_luong }}" value="1" />
                                <button type="button" class="quantity-btn plus">+</button>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            @if($book->so_luong > 0)
                                <button class="add-to-cart-btn" data-book-id="{{ $book->id }}">
                                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                                </button>
                                <button class="buy-now-btn" data-book-id="{{ $book->id }}">
                                    <i class="fas fa-bolt"></i> Mua ngay
                                </button>
                            @else
                                <button class="notify-btn" data-book-id="{{ $book->id }}">
                                    <i class="fas fa-bell"></i> Thông báo khi có hàng
                                </button>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Book Info Tabs -->
                    <div class="book-info-tabs">
                        <div class="tab-headers">
                            <div class="tab-header active" data-tab="description">Chi tiết sản phẩm</div>
                            <div class="tab-header" data-tab="delivery">Thông tin giao hàng</div>
                        </div>
                        <div class="tab-content">
                            <div id="description" class="tab-pane active">
                                <div class="book-info-table">
                                    <table>
                                        <tr>
                                            <td class="label">Tác giả</td>
                                            <td>{{ $book->tacGia->ten_tac_gia }}</td>
                                        </tr>
                                        <tr>
                                            <td class="label">Số lượng</td>
                                            <td>{{ $book->so_luong }}</td>
                                        </tr>
                                    </table>
                                </div>
                                
                                @if($book->gioi_thieu)
                                <div class="book-introduction">
                                    <h3>Giới thiệu sách</h3>
                                    <div class="introduction-content">
                                        {!! nl2br(e($book->gioi_thieu)) !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div id="delivery" class="tab-pane">
                                <div class="delivery-info">
                                    <h3>Chính sách giao hàng</h3>
                                    <ul>
                                        <li>Miễn phí giao hàng cho đơn hàng từ 500.000₫</li>
                                        <li>Giao hàng toàn quốc</li>
                                        <li>Thời gian giao hàng: 2-5 ngày làm việc</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Phần bình luận -->
    <div class="container mt-4">
        <x-book-comments :book="$book" />
    </div>
    
    <!-- Related Books Section -->
    <section class="book-detail-related">
        <div class="container">
            <h2 class="book-detail-related-title">Sách cùng quốc gia</h2>
            <div class="book-detail-related-slider">
                @if($relatedBooks->count() > 0)
                    <div class="swiper book-detail-related-swiper">
                        <div class="swiper-wrapper">
                            @foreach($relatedBooks as $relatedBook)
                                <div class="swiper-slide">
                                    <div class="book-detail-related-item">
                                        <a href="{{ url('/books/detail/' . $relatedBook->id) }}">
                                            <img src="{{ !empty($relatedBook->anh) ? asset('storage/' . $relatedBook->anh) : asset('images/default-book.jpg') }}" 
                                                 alt="{{ $relatedBook->ten_sach }}" class="img-fluid">
                                            <h4>{{ $relatedBook->ten_sach }}</h4>
                                            <p class="book-detail-related-price">{{ number_format($relatedBook->gia_tien, 0, ',', '.') }}₫</p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                @else
                    <div class="book-detail-related-empty">Không có sách liên quan</div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection

<!-- Thêm JavaScript cho trang chi tiết sách -->
<script src="{{ asset('js/detail.js') }}" defer></script>

<!-- Thêm Swiper JS và CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper(".book-detail-related-swiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                640: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 4 }
            }
        });
    });
</script>