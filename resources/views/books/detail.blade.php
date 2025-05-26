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
        <div class="card">
            <div class="card-body">
                <h4 class="section-title">Bình luận</h4>
                
                @auth('khach_hang')
                    <form id="commentForm" class="comment-form">
                        @csrf
                        <input type="hidden" name="id_sach" value="{{ $book->id }}">
                        <div class="form-group">
                            <textarea class="form-control comment-input" name="comment" rows="3" placeholder="Viết bình luận của bạn..."></textarea>
                        </div>
                        <div class="text-right mt-2">
                            <button type="submit" class="btn-comment">Gửi bình luận</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info">
                        Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.
                    </div>
                @endauth

                <div class="comments-list mt-4" id="commentsList">
                    @foreach($book->comments()->with('khachHang')->orderBy('created_at', 'desc')->get() as $comment)
                        <div class="comment-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar">
                                        <i class="fas fa-user-circle fa-2x"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="comment-author">{{ $comment->khachHang->ho_ten }}</h6>
                                    <p class="comment-text">{{ $comment->comment }}</p>
                                    <small class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Books Section -->
    <section class="related-books">
        <div class="container">
            <h2 class="section-title">Sách liên quan</h2>
            <div class="books-slider">
                <!-- Placeholder for related books -->
                <div class="book-slide-message">Đang tải sách liên quan...</div>
            </div>
        </div>
    </section>
</div>
@endsection

<!-- Thêm JavaScript cho trang chi tiết sách -->
<script src="{{ asset('js/detail.js') }}" defer></script>

<style>
.section-title {
    color: #2F5A33;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #2F5A33;
}

.comment-form {
    margin-bottom: 30px;
}

.comment-input {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 12px;
    resize: none;
}

.comment-input:focus {
    border-color: #2F5A33;
    box-shadow: 0 0 0 0.2rem rgba(47, 90, 51, 0.25);
}

.btn-comment {
    background-color: #2F5A33;
    color: #fff;
    padding: 8px 20px;
    border: none;
    border-radius: 4px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-comment:hover {
    background-color: #1e3b21;
}

.comments-list {
    max-height: 500px;
    overflow-y: auto;
    padding-right: 10px;
}

.comment-item {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 15px;
}

.comment-author {
    color: #2F5A33;
    margin-bottom: 5px;
    font-weight: 600;
}

.comment-text {
    color: #333;
    margin-bottom: 5px;
}

.comment-date {
    color: #666;
}

.avatar {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2F5A33;
}

.alert-info {
    background-color: #f8f9fa;
    border: 1px solid #2F5A33;
    color: #2F5A33;
    padding: 15px;
    border-radius: 4px;
}

.alert-info a {
    color: #2F5A33;
    font-weight: 600;
    text-decoration: none;
}

.alert-info a:hover {
    text-decoration: underline;
}

.text-right {
    text-align: right;
}
</style>