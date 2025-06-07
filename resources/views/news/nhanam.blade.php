@extends('layouts.app')

@section('title', 'Tin Green Book')

@section('styles')
    <link href="{{ asset('css/news.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Tin Green Book</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <h1 class="title-module">Tin Green Book</h1>
            <div class="news-row">
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/ra-mat-ban-dich-tac-pham-cuon-sach-hoang-da-cua-tac-gia-juan-villoro" title="Ra mắt bản dịch tác phẩm Cuốn sách hoang dã của tác giả Juan Villoro">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/494621307-1097261965774870-6550418258675179038-n.jpg?v=1746519986820') }}" alt="Ra mắt bản dịch tác phẩm Cuốn sách hoang dã của tác giả Juan Villoro" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/ra-mat-ban-dich-tac-pham-cuon-sach-hoang-da-cua-tac-gia-juan-villoro" title="Ra mắt bản dịch tác phẩm Cuốn sách hoang dã của tác giả Juan Villoro" class="a-title">Ra mắt bản dịch tác phẩm "Cuốn sách hoang dã" của tác giả Juan Villoro</a></h3>
                        <span>Thứ Ba, 06/05/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/su-kien-gioi-thieu-tac-pham-doc-duong-2-va-gap-go-nha-van-nguyen-ngoc" title="Sự kiện giới thiệu tác phẩm Dọc đường 2 và gặp gỡ nhà văn Nguyên Ngọc">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/491279363-1088490436652023-2743767814237791180-n.jpg?v=1745208865993') }}" alt="Sự kiện giới thiệu tác phẩm Dọc đường 2 và gặp gỡ nhà văn Nguyên Ngọc" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/su-kien-gioi-thieu-tac-pham-doc-duong-2-va-gap-goc-nha-van-nguyen-ngoc" title="Sự kiện giới thiệu tác phẩm Dọc đường 2 và gặp gỡ nhà văn Nguyên Ngọc" class="a-title">Sự kiện giới thiệu tác phẩm "Dọc đường 2" và gặp gỡ nhà văn Nguyên Ngọc</a></h3>
                        <span>Thứ Hai, 21/04/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/hoi-sach-nha-nam-chao-he-2025" title="HỘI SÁCH GREEN BOOK CHÀO HÈ 2025">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/489006758-1079586880875712-661463280947496865-n.jpg?v=1744100699603') }}" alt="HỘI SÁCH GREEN BOOK CHÀO HÈ 2025" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/hoi-sach-nha-nam-chao-he-2025" title="HỘI SÁCH GREEN BOOK CHÀO HÈ 2025" class="a-title">HỘI SÁCH GREEN BOOK CHÀO HÈ 2025</a></h3>
                        <span>Thứ Ba, 08/04/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/su-kien-nhung-cau-chuyen-nghe-phap-y-gioi-thieu-bo-sach-phap-y-bao-cao-phap-y-ho-so-di-cot-tu-thi-ke-chuyen-chet-chua-phai-la-het" title="Sự kiện: NHỮNG CÂU CHUYỆN NGHỀ PHÁP Y - Giới thiệu bộ sách pháp y: Báo cáo pháp y, Hồ sơ di cốt, Tử thi kể chuyện, Chết chưa phải là hết">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/484799317-1063744625793271-7677298375345374751-n.jpg?v=1742792125167') }}" alt="Sự kiện: NHỮNG CÂU CHUYỆN NGHỀ PHÁP Y - Giới thiệu bộ sách pháp y: Báo cáo pháp y, Hồ sơ di cốt, Tử thi kể chuyện, Chết chưa phải là hết" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/su-kien-nhung-cau-chuyen-nghe-phap-y-gioi-thieu-bo-sach-phap-y-bao-cao-phap-y-ho-so-di-cot-tu-thi-ke-chuyen-chet-chua-phai-la-het" title="Sự kiện: NHỮNG CÂU CHUYỆN NGHỀ PHÁP Y - Giới thiệu bộ sách pháp y: Báo cáo pháp y, Hồ sơ di cốt, Tử thi kể chuyện, Chết chưa phải là hết" class="a-title">Sự kiện: NHỮNG CÂU CHUYỆN NGHỀ PHÁP Y - Giới thiệu bộ sách pháp y: Báo cáo pháp y, Hồ sơ di cốt, Tử thi kể chuyện, Chết chưa phải là hết</a></h3>
                        <span>Thứ Hai, 24/03/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/tro-chuyen-ve-cuon-sach-chuyen-nha-ti-cua-nha-van-phan-thi-vang-anh" title="Trò chuyện về cuốn sách: Chuyện nhà Tí của nhà văn Phan Thị Vàng Anh">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/website-a-nh-da-i-die-n-ba-i-vie-t-17-51a80241-426c-4785-b5e1-9aedf8dff8c0.png?v=1742197752157') }}" alt="Trò chuyện về cuốn sách: Chuyện nhà Tí của nhà văn Phan Thị Vàng Anh" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/tro-chuyen-ve-cuon-sach-chuyen-nha-ti-cua-nha-van-phan-thi-vang-anh" title="Trò chuyện về cuốn sách: Chuyện nhà Tí của nhà văn Phan Thị Vàng Anh" class="a-title">Trò chuyện về cuốn sách: Chuyện nhà Tí của nhà văn Phan Thị Vàng Anh</a></h3>
                        <span>Thứ Hai, 17/03/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/su-kien-giao-luu-voi-tac-gia-va-dich-gia-bo-con-ca-gai" title="Sự kiện giao lưu với tác giả và dịch giả Bố con cá gai">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/480203269-1042894241211643-9180551152830458713-n.jpg?v=1740994652690') }}" alt="Sự kiện giao lưu với tác giả và dịch giả Bố con cá gai" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/su-kien-giao-luu-voi-tac-gia-va-dich-gia-bo-con-ca-gai" title="Sự kiện giao lưu với tác giả và dịch giả Bố con cá gai" class="a-title">Sự kiện giao lưu với tác giả và dịch giả "Bố con cá gai"</a></h3>
                        <span>Thứ Hai, 03/03/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/quyen-luc-cua-dat-dai" title="Quyền lực của đất đai">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/website-a-nh-da-i-die-n-ba-i-vie-t-14-42424747-4313-46a1-a9d9-0375b3214194.png?v=1740891085440') }}" alt="Quyền lực của đất đai" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/quyen-luc-cua-dat-dai" title="Quyền lực của đất đai" class="a-title">"Quyền lực" của đất đai</a></h3>
                        <span>Chủ Nhật, 02/03/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/su-kien-ra-mat-cuon-sach-dat-dai-ham-muon-so-huu-dinh-hinh-the-gioi-hien-dai" title="Sự kiện: Ra mắt cuốn sách ĐẤT ĐAI - Ham muốn sở hữu định hình thế giới hiện đại">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/1-13cd774c-b58f-461e-9a81-9e614842fb12.png?v=1740115538713') }}" alt="Sự kiện: Ra mắt cuốn sách ĐẤT ĐAI - Ham muốn sở hữu định hình thế giới hiện đại" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/su-kien-ra-mat-cuon-sach-dat-dai-ham-muon-so-huu-dinh-hinh-the-gioi-hien-dai" title="Sự kiện: Ra mắt cuốn sách ĐẤT ĐAI - Ham muốn sở hữu định hình thế giới hiện đại" class="a-title">Sự kiện: Ra mắt cuốn sách ĐẤT ĐAI - Ham muốn sở hữu định hình thế giới hiện đại</a></h3>
                        <span>Thứ Sáu, 21/02/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/su-kien-ra-mat-cuon-sach-bieu-tuong-phu-hieu-va-do-tho-cua-nguoi-an-nam-cua-tac-gia-gustave-dumoutier" title="Sự kiện: Ra mắt cuốn sách Biểu tượng, phù hiệu và đồ thờ của người An Nam của tác giả Gustave Dumoutier">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/477685389-1035235648644169-7953768034719337909-n.jpg?v=1739352974687') }}" alt="Sự kiện: Ra mắt cuốn sách Biểu tượng, phù hiệu và đồ thờ của người An Nam của tác giả Gustave Dumoutier" class="lazyload img-responsive loaded" data-was-processed="true">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/su-kien-ra-mat-cuon-sach-bieu-tuong-phu-hieu-va-do-tho-cua-nguoi-an-nam-cua-tac-gia-gustave-dumoutier" title="Sự kiện: Ra mắt cuốn sách Biểu tượng, phù hiệu và đồ thờ của người An Nam của tác giả Gustave Dumoutier" class="a-title">Sự kiện: Ra mắt cuốn sách "Biểu tượng, phù hiệu và đồ thờ của người An Nam" của tác giả Gustave Dumoutier</a></h3>
                        <span>Thứ Tư, 12/02/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/su-kien-ra-mat-sach-ve-tho-cung-co-truyen-thu-hut-doc-gia-tre" title="Sự kiện ra mắt sách về thờ cúng cổ truyền thu hút độc giả trẻ">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/anh-man-hinh-2025-02-04-luc-11-54-02-min.png?v=1738650339857') }}" alt="Sự kiện ra mắt sách về thờ cúng cổ truyền thu hút độc giả trẻ" class="lazyload img-responsive">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/su-kien-ra-mat-sach-ve-tho-cung-co-truyen-thu-hut-doc-gia-tre" title="Sự kiện ra mắt sách về thờ cúng cổ truyền thu hút độc giả trẻ" class="a-title">Sự kiện ra mắt sách về thờ cúng cổ truyền thu hút độc giả trẻ</a></h3>
                        <span>Thứ Ba, 04/02/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/hoi-sach-xuan-nha-nam-nam-2025" title="Rộn ràng Hội sách Xuân Green Book năm 2025">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/474668297-1020349856799415-3183947564088782807-n.jpg?v=1737535559097') }}" alt="Rộn ràng Hội sách Xuân Green Book năm 2025" class="lazyload img-responsive">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/hoi-sach-xuan-nha-nam-nam-2025" title="Rộn ràng Hội sách Xuân Green Book năm 2025" class="a-title">Rộn ràng Hội sách Xuân Green Book năm 2025</a></h3>
                        <span>Thứ Tư, 22/01/2025</span>
                    </div>
                </article>
                <article class="item_blog_base">
                    <a class="thumb radius-5" href="/chuong-trinh-tu-thien-mua-xuan-ta-lung-mang-sach-cho-em-cung-nha-nam-xay-dung-tu-sach-va-lan-toa-van-hoa-doc-toi-hoc-sinh-vung-cao" title="Chương trình từ thiện &quot;Mùa xuân Tả Lủng - Mang sách cho em&quot;: Cùng Green Book xây dựng tủ sách và lan tỏa văn hóa đọc tới học sinh vùng cao">
                        <img src="{{ asset('https://bizweb.dktcdn.net/100/363/455/articles/z6213865224494-00a387c64091daae8adec279ff5285e3.jpg?v=1736765764973') }}" alt="Chương trình từ thiện &quot;Mùa xuân Tả Lủng - Mang sách cho em&quot;: Cùng Green Book xây dựng tủ sách và lan tỏa văn hóa đọc tới học sinh vùng cao" class="lazyload img-responsive">
                    </a>
                    <div class="content_blog">
                        <h3><a href="/chuong-trinh-tu-thien-mua-xuan-ta-lung-mang-sach-cho-em-cung-nha-nam-xay-dung-tu-sach-va-lan-toa-van-hoa-doc-toi-hoc-sinh-vung-cao" title="Chương trình từ thiện &quot;Mùa xuân Tả Lủng - Mang sách cho em&quot;: Cùng Green Book xây dựng tủ sách và lan tỏa văn hóa đọc tới học sinh vùng cao" class="a-title">Chương trình từ thiện "Mùa xuân Tả Lủng - Mang sách cho em": Cùng Green Book xây dựng tủ sách và lan tỏa văn hóa đọc tới học sinh vùng cao</a></h3>
                        <span>Thứ Hai, 13/01/2025</span>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection 