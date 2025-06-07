@extends('layouts.app')
@section('content')
@section('styles')
    <link href="{{ asset('css/static-pages.css') }}" rel="stylesheet">
@endsection
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Hệ thống hiệu sách</li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="static-container">
            <h1 class="title-module">Hệ thống hiệu sách</h1>
            <div class="stores-flex" style="display: flex; flex-wrap: wrap; gap: 32px; align-items: flex-start;">
                <div class="stores-list" style="flex: 1 1 260px; min-width: 220px;">
                    <ul style="list-style: none; padding: 0;">
                        <li class="store-item" style="margin-bottom: 18px;">
                            <div class="district"><strong>Cầu Giấy</strong></div>
                            <div>Tầng 3, TTTM IPH, 241 Xuân Thủy, Cầu Giấy, Hà Nội - ĐT: 0246.659.4535</div>
                        </li>
                        <li class="store-item" style="margin-bottom: 18px;">
                            <div class="district"><strong>Cầu Giấy</strong></div>
                            <div>59 Đỗ Quang, Trung Hòa, Cầu Giấy, Hà Nội - ĐT: 0243.514.6875</div>
                        </li>
                        <!-- Thêm các cửa hàng khác nếu có -->
                    </ul>
                </div>
                <div class="stores-map" style="flex: 2 1 400px; min-width: 300px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9235014211913!2d105.78027207591815!3d21.03574668753735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4ab82e8a2d%3A0xe52fd6b755ba654c!2zMjQxIFh1w6JuIFRo4buneSwgROG7i2NoIFbhu41uZyBI4bqtdSwgQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1697618323222!5m2!1svi!2s" width="100%" height="350" style="border:0; border-radius:8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection 