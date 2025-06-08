@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="active">Giỏ hàng</li>
        </ul>
    </div>
</div>

<div class="cart-container">
    <div class="container">
        <div class="cart-content">
            <h1 class="cart-title">Giỏ hàng của bạn</h1>

            @if($data['cartItems']->isEmpty())
                <div class="empty-cart">
                    <p>Giỏ hàng của bạn hiện đang trống.</p>
                    <a href="{{ url('/') }}" class="continue-btn">Tiếp tục mua hàng</a>
                </div>
            @else
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th class="image-col">Ảnh</th>
                                <th class="item-col">Sản phẩm</th>
                                <th class="price-col">Đơn giá</th>
                                <th class="quantity-col">Số lượng</th>
                                <th class="total-col">Thành tiền</th>
                                <th class="remove-col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['cartItems'] as $item)
                                @if($data['is_logged_in'])
                                    <tr data-cart-detail-id="{{ $item->id }}">
                                        <td class="image-col">
                                            <a href="{{ route('books.detail', ['id' => $item->sach->id]) }}">
                                                <img src="{{ !empty($item->sach->anh) ? asset('storage/' . $item->sach->anh) : asset('images/default-book.jpg') }}" alt="{{ $item->sach->ten_sach }}">
                                            </a>
                                        </td>
                                        <td class="item-col">
                                            <a href="{{ route('books.detail', ['id' => $item->sach->id]) }}">{{ $item->sach->ten_sach }}</a>
                                        </td>
                                        <td class="price-col">
                                            <span class="price">{{ number_format($item->gia_tien, 0, ',', '.') }}₫</span>
                                        </td>
                                        <td class="quantity-col">
                                            <div class="quantity-controls">
                                                <button type="button" class="quantity-btn minus"><i class="fas fa-minus"></i></button>
                                                <input type="number" value="{{ $item->so_luong }}" class="quantity-input" data-cart-detail-id="{{ $item->id }}" min="1" max="{{ $item->sach->so_luong }}">
                                                <button type="button" class="quantity-btn plus"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="total-col">
                                            <span class="total">{{ number_format($item->thanh_tien, 0, ',', '.') }}₫</span>
                                        </td>
                                        <td class="remove-col">
                                            <button type="button" class="remove-item" data-cart-detail-id="{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @else
                                    <tr data-cart-detail-id="{{ $item->book_id }}">
                                        <td class="image-col">
                                            <a href="{{ route('books.detail', ['id' => $item->book_id]) }}">
                                                <img src="{{ !empty($item->anh) ? asset('storage/' . $item->anh) : asset('images/default-book.jpg') }}" alt="{{ $item->ten_sach }}">
                                            </a>
                                        </td>
                                        <td class="item-col">
                                            <a href="{{ route('books.detail', ['id' => $item->book_id]) }}">{{ $item->ten_sach }}</a>
                                        </td>
                                        <td class="price-col">
                                            <span class="price">{{ number_format($item->gia_tien, 0, ',', '.') }}₫</span>
                                        </td>
                                        <td class="quantity-col">
                                            <div class="quantity-controls">
                                                <button type="button" class="quantity-btn minus"><i class="fas fa-minus"></i></button>
                                                <input type="number" value="{{ $item->quantity }}" class="quantity-input" data-cart-detail-id="{{ $item->book_id }}" min="1">
                                                <button type="button" class="quantity-btn plus"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="total-col">
                                            <span class="total">{{ number_format($item->thanh_tien, 0, ',', '.') }}₫</span>
                                        </td>
                                        <td class="remove-col">
                                            <button type="button" class="remove-item" data-cart-detail-id="{{ $item->book_id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-actions">
                    <div class="continue-shopping">
                        <a href="{{ url('/') }}" class="continue-btn">Tiếp tục mua hàng</a>
                    </div>
                </div>

                <div class="cart-summary">
                    <div class="order-total">
                        <div class="total-line">
                            <span class="total-label">Tạm tính:</span>
                            <span class="total-amount">{{ number_format($data['subTotal'], 0, ',', '.') }}₫</span>
                        </div>
                        <div class="total-line">
                            <span class="total-label">VAT (10%):</span>
                            <span class="total-amount">{{ number_format($data['vat'], 0, ',', '.') }}₫</span>
                        </div>
                        <div class="total-line">
                            <span class="total-label">Phí vận chuyển:</span>
                            <span class="total-amount">
                                @if($data['shipping'] > 0)
                                    {{ number_format($data['shipping'], 0, ',', '.') }}₫
                                @else
                                    <span class="free-shipping">Miễn phí</span>
                                @endif
                            </span>
                        </div>
                        @if($data['shipping'] > 0)
                        <div class="shipping-note">
                            <i class="fas fa-info-circle"></i>
                            Mua thêm {{ number_format($data['free_shipping_threshold'] - $data['subTotal'], 0, ',', '.') }}₫ để được miễn phí vận chuyển
                        </div>
                        @endif
                        <div class="total-line grand-total">
                            <span class="total-label">Tổng cộng:</span>
                            <span class="total-amount">{{ number_format($data['orderTotal'], 0, ',', '.') }}₫</span>
                        </div>
                        <p class="vat-note">Đã bao gồm VAT (nếu có)</p>
                        
                        @auth('khach_hang')
                            <a href="{{ route('cart.checkout') }}" class="checkout-btn">Thanh toán</a>
                        @else
                            <div class="login-notice">
                                <div class="login-btn-container">
                                    <a href="{{ route('login') }}" class="checkout-btn">Đăng nhập để thanh toán</a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/pages/cart.js') }}"></script>
@endpush