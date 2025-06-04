@extends('layouts.app')

@section('title', 'Review sách của độc giả')

@section('styles')
    {{-- We can reuse news.css as the layout is similar --}}
    <link href="{{ asset('css/news.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Review sách của độc giả</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h1 class="title-module">Review sách của độc giả</h1>

                    <div class="row">
                        {{-- Review articles will be listed here --}}
                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-vu-an-mang-o-nha-khach-nui-hakuba-higashino-keigo-1" title="Review sách: VỤ ÁN MẠNG Ở NHÀ KHÁCH NÚI HAKUBA – Higashino Keigo">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-33-7b9f3ef0-ba76-4b71-a8a4-8ec077c1ccdf.png?v=1695978881973" alt="Review sách: VỤ ÁN MẠNG Ở NHÀ KHÁCH NÚI HAKUBA – Higashino Keigo" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-vu-an-mang-o-nha-khach-nui-hakuba-higashino-keigo-1" title="Review sách: VỤ ÁN MẠNG Ở NHÀ KHÁCH NÚI HAKUBA – Higashino Keigo" class="a-title">Review sách: VỤ ÁN MẠNG Ở NHÀ KHÁCH NÚI HAKUBA – Higashino Keigo</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-vong-tay-hoc-tro-nguyen-thi-hoang-1" title="Review sách: VÒNG TAY HỌC TRÒ – Nguyễn Thị Hoàng">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-32-3c8a2920-c0f0-4b03-9de5-fae4584733d9.png?v=1695978750610" alt="Review sách: VÒNG TAY HỌC TRÒ – Nguyễn Thị Hoàng" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-vong-tay-hoc-tro-nguyen-thi-hoang-1" title="Review sách: VÒNG TAY HỌC TRÒ – Nguyễn Thị Hoàng" class="a-title">Review sách: VÒNG TAY HỌC TRÒ – Nguyễn Thị Hoàng</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-huyen-tuong-ve-tri-tue-nhan-tao-gary-smith-1" title="Review sách: HUYỄN TƯỞNG VỀ TRÍ TUỆ NHÂN TẠO – Gary Smith">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-31-8ec78c0a-7f81-4227-afe8-47774250c5db.png?v=1695978683347" alt="Review sách: HUYỄN TƯỞNG VỀ TRÍ TUỆ NHÂN TẠO – Gary Smith" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-huyen-tuong-ve-tri-tue-nhan-tao-gary-smith-1" title="Review sách: HUYỄN TƯỞNG VỀ TRÍ TUỆ NHÂN TẠO – Gary Smith" class="a-title">Review sách: HUYỄN TƯỞNG VỀ TRÍ TUỆ NHÂN TẠO – Gary Smith</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-dieu-nay-roi-cung-qua-milena-busquets-1" title="Review sách: ĐIỀU NÀY RỒI CŨNG QUA – Milena Busquets">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-30-cde8901f-98bc-4e81-a05e-bb9e5219e0a0.png?v=1695978362157" alt="Review sách: ĐIỀU NÀY RỒI CŨNG QUA – Milena Busquets" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-dieu-nay-roi-cung-qua-milena-busquets-1" title="Review sách: ĐIỀU NÀY RỒI CŨNG QUA – Milena Busquets" class="a-title">Review sách: ĐIỀU NÀY RỒI CŨNG QUA – Milena Busquets</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-trai-tim-cua-brustus-higashino-keigo" title="Review sách: TRÁI TIM CỦA BRUTUS – Higashino Keigo">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-29-b82fde18-7b11-46a9-aea7-e3e18158fcd1.png?v=1695978256867" alt="Review sách: TRÁI TIM CỦA BRUTUS – Higashino Keigo" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-trai-tim-cua-brustus-higashino-keigo" title="Review sách: TRÁI TIM CỦA BRUTUS – Higashino Keigo" class="a-title">Review sách: TRÁI TIM CỦA BRUTUS – Higashino Keigo</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-kho-bau-bi-nguyen-rua-michel-bussi" title="Review sách: KHO BÁU BỊ NGUYỀN RỦA – Michel Bussi">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-28-1c7f56f0-5c45-4b1b-8200-5d708c8fb895.png?v=1695978021183" alt="Review sách: KHO BÁU BỊ NGUYỀN RỦA – Michel Bussi" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-kho-bau-bi-nguyen-rua-michel-bussi" title="Review sách: KHO BÁU BỊ NGUYỀN RỦA – Michel Bussi" class="a-title">Review sách: KHO BÁU BỊ NGUYỀN RỦA – Michel Bussi</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-khu-vuon-bi-mat-frances-hodgson-burnett" title="Review sách: KHU VƯỜN BÍ MẬT – Frances Hodgson Burnett">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-27-cd364d04-3821-4434-8886-6bf605a35512.png?v=1695976437050" alt="Review sách: KHU VƯỜN BÍ MẬT – Frances Hodgson Burnett" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-khu-vuon-bi-mat-frances-hodgson-burnett" title="Review sách: KHU VƯỜN BÍ MẬT – Frances Hodgson Burnett" class="a-title">Review sách: KHU VƯỜN BÍ MẬT – Frances Hodgson Burnett</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-jane-eyre-charlotte-bronte" title="Review sách: JANE EYRE – Charlotte Bronte">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-26-741ee84b-fc5d-4ceb-855b-4b8a5ca02012.png?v=1695976325807" alt="Review sách: JANE EYRE – Charlotte Bronte" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-jane-eyre-charlotte-bronte" title="Review sách: JANE EYRE – Charlotte Bronte" class="a-title">Review sách: JANE EYRE – Charlotte Bronte</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-co-gai-va-man-dem-guillaume-musso-1" title="Review sách: CÔ GÁI VÀ MÀN ĐEM – Guillaume Musso">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-25-b1399d5f-9ff4-47ac-978c-853d867760c8.png?v=1695976192143" alt="Review sách: CÔ GÁI VÀ MÀN ĐEM – Guillaume Musso" class="lazyload img-responsive loaded" data-was-processed="true">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-co-gai-va-man-dem-guillaume-musso-1" title="Review sách: CÔ GÁI VÀ MÀN ĐEM – Guillaume Musso" class="a-title">Review sách: CÔ GÁI VÀ MÀN ĐEM – Guillaume Musso</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-quai-thu-c-j-skuse" title="Review sách: QUÁI THÚ – C.J. Skuse">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-23-c194fc2d-2234-4435-8374-682167ca9b86.png?v=1695976017267" alt="Review sách: QUÁI THÚ – C.J. Skuse" class="lazyload img-responsive">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-quai-thu-c-j-skuse" title="Review sách: QUÁI THÚ – C.J. Skuse" class="a-title">Review sách: QUÁI THÚ – C.J. Skuse</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-tu-nhan-cua-thien-duong-carlos-ruiz-zafon" title="Review sách: TÙ NHÂN CỦA THIÊN ĐƯỜNG - Carlos Ruiz Zafon">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-22-cc907bf1-808b-4126-86a9-b202882be1ab.png?v=1695974745690" alt="Review sách: TÙ NHÂN CỦA THIÊN ĐƯỜNG - Carlos Ruiz Zafon" class="lazyload img-responsive">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-tu-nhan-cua-thien-duong-carlos-ruiz-zafon" title="Review sách: TÙ NHÂN CỦA THIÊN ĐƯỜNG - Carlos Ruiz Zafon" class="a-title">Review sách: TÙ NHÂN CỦA THIÊN ĐƯỜNG - Carlos Ruiz Zafon</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-12 col-lg-4 col-xl-4">
                            <article class="item_blog_base">
                                <a class="thumb radius-5" href="/review-sach-lang-nghe-gio-hat-haruki-murakami" title="Review sách: LĂNG NGHE GIÓ HÁT - Haruki Murakami">
                                    <img src="https://bizweb.dktcdn.net/100/363/455/articles/review-hen-gap-lai-tren-kia-pierre-lemaitre-21-ad91764f-4ba7-4211-935b-c8f7a4557d92.png?v=1695974640110" alt="Review sách: LĂNG NGHE GIÓ HÁT - Haruki Murakami" class="lazyload img-responsive">
                                </a>
                                <div class="content_blog">
                                    <h3><a href="/review-sach-lang-nghe-gio-hat-haruki-murakami" title="Review sách: LĂNG NGHE GIÓ HÁT - Haruki Murakami" class="a-title">Review sách: LĂNG NGHE GIÓ HÁT - Haruki Murakami</a></h3>
                                    <span>
                                        Thứ Sáu,
                                        29/09/2023
                                    </span>
                                </div>
                            </article>
                        </div>

                    </div>
                    <div class="text-xs-right pagenav section clearfix">
                        {{-- Pagination links will go here --}}
                        {{-- Assuming $reviews is passed and is a paginated collection --}}
                        {{-- $reviews->links() --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 