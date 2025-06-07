@extends('layouts.app')
@section('content')
@section('styles')
    <link href="{{ asset('css/news.css') }}" rel="stylesheet">
@endsection
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Cuộc thi</li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h1 class="title-module">Cuộc thi</h1>
                    <div class="contest-list">
                        <div class="contest-item">
                            <h2><a href="{{ route('news.ai_doc_cung_ta') }}">Ai đó đọc cùng ta</a></h2>
                            <p>Cuộc thi review sách với những cảm nhận chân thành và sâu sắc về các tác phẩm văn học.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 