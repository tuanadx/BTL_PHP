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
                <li class="active">Biên tập viên giới thiệu</li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="container">
            <h1 class="title-module">Biên tập viên giới thiệu</h1>
            <div class="news-row">
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/hanh-trinh-kham-pha-su-phat-trien-cua-nghe-thuat-am-thanh-qua-cac-thoi-dai" title="Hành trình khám phá sự phát triển của nghệ thuật âm thanh qua các thời đại">
                        <img src="https://bizweb.dktcdn.net/100/363/455/articles/website-a-nh-da-i-die-n-ba-i-vie-t-16.png?v=1742196083043" alt="Hành trình khám phá sự phát triển của nghệ thuật âm thanh qua các thời đại" class="img-responsive">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/hanh-trinh-kham-pha-su-phat-trien-cua-nghe-thuat-am-thanh-qua-cac-thoi-dai" title="Hành trình khám phá sự phát triển của nghệ thuật âm thanh qua các thời đại" class="a-title">Hành trình khám phá sự phát triển của nghệ thuật âm thanh qua các thời đại</a></h3>
                        <span>Thứ Hai, 17/03/2025</span>
                    </div>
                </article>

                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/con-nguoi-va-dat-dai" title="Con người và đất đai">
                        <img src="https://bizweb.dktcdn.net/100/363/455/articles/website-a-nh-da-i-die-n-ba-i-vie-t-15-4fb29d69-bd22-42ca-97c1-90b72f353915.png?v=1742194941080" alt="Con người và đất đai" class="img-responsive">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/con-nguoi-va-dat-dai" title="Con người và đất đai" class="a-title">Con người và đất đai</a></h3>
                        <span>Thứ Hai, 17/03/2025</span>
                    </div>
                </article>

                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/pha-ca-phe-ngon-tai-nha-mot-cam-nang-toan-dien-de-pha-ca-phe-ngon-ngay-trong-can-bep-cua-ban" title="Pha cà phê ngon tại nhà - Một cẩm nang toàn diện để pha cà phê ngon ngay trong căn bếp của bạn">
                        <img src="https://bizweb.dktcdn.net/100/363/455/articles/6.png?v=1739681217893" alt="Pha cà phê ngon tại nhà" class="img-responsive">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/pha-ca-phe-ngon-tai-nha-mot-cam-nang-toan-dien-de-pha-ca-phe-ngon-ngay-trong-can-bep-cua-ban" title="Pha cà phê ngon tại nhà" class="a-title">"Pha cà phê ngon tại nhà" - Một cẩm nang toàn diện để pha cà phê ngon ngay trong căn bếp của bạn</a></h3>
                        <span>Chủ Nhật, 16/02/2025</span>
                    </div>
                </article>
            </div>
        </div>
    </section>
</main>
@endsection 