<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <title>{{ isset($title) ? $title : 'Nhà sách online' }}</title>
    <!-- Main CSS -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Detail CSS -->
    <link href="{{ asset('css/detail.css') }}" rel="stylesheet">
    <!-- Cart CSS -->
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- App JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Dropdown JavaScript -->
    <script src="{{ asset('js/dropdown.js') }}"></script>
    <!-- Component specific JavaScript -->
    @stack('scripts')
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="https://www.transparentpng.com/download/books/quality-green-book-logo-icon-transparent-8edO01.png" alt="Green Book">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-3 col-9">
                        <div class="navigation-head">
                            <nav class="nav-horizontal">
                                <ul class="item_big">
                                    <li class="nav-item">
                                        <a class="a-img" href="{{ url('/') }}" title="Trang chủ">Trang chủ</a>
                                    </li>
                                    <li class="nav-item has-child">
                                        <a class="a-img caret-down" href="{{ route('news.nhanam') }}" title="Tin Sách">Tin Sách</a>
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="item_small">
                                            <li><a href="{{ route('news.nhanam') }}" title="Tin tức Green Book">Tin Green Book</a></li>
                                            <li><a href="{{ route('news.reader_reviews') }}" title="Review sách của độc giả">Review sách của độc giả</a></li>
                                            <li><a href="{{ route('news.review_bao_chi') }}" title="Review sách trên báo chí">Review sách trên báo chí</a></li>
                                            <li><a href="{{ route('news.editor_recommendations') }}" title="Biên tập viên giới thiệu">Biên tập viên giới thiệu</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="a-img" href="{{ route('authors.index') }}" title="Tác giả">Tác giả</a>
                                    </li>
                                    <li class="nav-item has-child">
                                        <a class="a-img caret-down" href="{{ url('/cuoc-thi') }}" title="Cuộc Thi">Cuộc Thi</a>
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="item_small">
                                            <li><a href="{{ url('/ai-do-doc-cung-ta') }}">AI ĐÓ ĐỌC CÙNG TA</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="a-img" href="{{ url('/gioi-thieu') }}" title="Về Green Book">Về Green Book</a>
                                    </li>
                                    <li class="nav-item has-child">
                                        <a class="a-img caret-down" href="{{ url('/he-thong-hieu-sach') }}" title="Liên hệ">Hệ thống</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                         <div class="header-right">
                            <div class="search-box">
                                <form action="{{ url('home/search') }}" method="get">
                                    <input type="text" placeholder="Tìm kiếm..." name="keyword" class="search-input">
                                    <button type="submit" class="search-button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="user-actions">
                                @if(Auth::guard('khach_hang')->check())
                                    <div class="user-dropdown">
                                        <a href="javascript:void(0);" class="user-toggle">
                                            <i class="fas fa-user"></i>
                                            <span>{{ Auth::guard('khach_hang')->user()->ho_ten }}</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </a>
                                        <div class="user-dropdown-content">
                                            <a href="{{ route('profile') }}">
                                                <i class="fas fa-user-circle"></i>
                                                Thông tin tài khoản
                                            </a>
                                            <a href="{{ route('order.list') }}">
                                                <i class="fas fa-history"></i>
                                                Lịch sử đơn hàng
                                            </a>
                                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: flex; align-items: center; padding: 8px 15px; color: inherit; text-decoration: none;">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span style="margin-left: 10px;">Đăng xuất</span>
                                            </a>
                                        </div>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    <div class="user-dropdown">
                                        <a href="javascript:void(0);" class="user-toggle">
                                            <i class="fas fa-user"></i>
                                        </a>
                                        <div class="user-dropdown-content">
                                            <a href="{{ route('login') }}">
                                                <i class="fas fa-sign-in-alt"></i>
                                                Đăng nhập
                                            </a>
                                            <a href="{{ route('register') }}">
                                                <i class="fas fa-user-plus"></i>
                                                Đăng ký
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <a href="{{ route('cart.view') }}" class="cart">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="cart-count">{{ session('cart_count', 0) }}</span>
                                </a>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
