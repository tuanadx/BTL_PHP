@extends('layouts.app')
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Về Nhã Nam</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="content-page rte offset-lg-1 offset-xl-2 col-xl-8 col-lg-10 col-md-12 col-sm-12 col-12">
                    <h1 class="title-block-page">Về Nhã Nam</h1>
                    <p style="margin-bottom: 11px; text-align: justify;">&nbsp;</p>
                    <p style="margin-bottom: 11px; text-align: justify;"><img data-thumb="original" original-height="540" original-width="850" src="//bizweb.dktcdn.net/100/363/455/files/untitled-design-1.png?v=1695720988683"></p>
                    <p style="margin-bottom: 11px; text-align: justify;">&nbsp;</p>
                    <p style="margin-bottom: 11px; text-align: justify;"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif"><strong><span style="font-family:Arial,Helvetica,sans-serif;">Nhã Nam</span></strong>, tên đầy đủ là Công ty Cổ phần Văn hóa và Truyền thông Nhã Nam,&nbsp;gia nhập thị trường sách Việt Nam vào tháng 2 năm 2005 với tác phẩm "<em>Balzac và cô bé thợ may Trung hoa</em>" của Đới Tư Kiệt.</span></span></p>
                    <p style="margin-bottom: 11px; text-align: justify;"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Ngay từ cuốn sách đầu tiên, độc giả đã dành sự quan tâm và yêu mến cho một thương hiệu sách mới mẻ mang trong mình khát vọng góp phần tạo lập diện mạo mới cho xuất bản văn học tại Việt Nam.</span></span></p>
                    <p style="margin-bottom: 11px; text-align: justify;"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Sau thành công vang dội của <em>Nhật ký Đặng Thùy Trâm</em> với gần 500,000 bản sách được phát hành, phá mọi kỷ lục về xuất bản trước đó, kéo theo một loạt những hiệu ứng xã hội và dư luận có ý nghĩa, Nhã Nam đã không ngừng giới thiệu với độc giả Việt Nam những&nbsp;cuốn sách văn học nước ngoài giá trị, thu hút nhiều tầng lớp độc giả. </span></span></p>
                    <p style="margin-bottom: 11px; text-align: justify;"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Sách của Nhã Nam nổi bật bởi nội dung văn học tinh tế, bởi vẻ đẹp của thiết kế tinh tế, bởi sự chăm chút kỹ lưỡng cho mỗi cuốn sách.</span></span></p>
                    <p style="margin-bottom: 11px; text-align: justify;"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Nhã Nam, trên thực tế, đã trở thành một người bạn tinh thần, người định hướng đọc sách cho rất nhiều bạn trẻ, là cầu nối giữa độc giả Việt Nam với nền văn hóa đọc mênh mông của thế giới.</span></span></p>
                    <p style="margin-bottom: 11px; text-align: justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Song song với dòng sách văn học vốn là thế mạnh, với sự trưởng thành mạnh mẽ của tổ chức, Nhã Nam đã mở rộng sự quan tâm sang các mảng sách non-fiction như lịch sử, triết học, khoa học, sách về các vấn đề xã hội, văn hóa đương đại, sách khai trí, tham khảo, triết lý<span style="margin-bottom:11px;text-align:justify;"> sống... Trong lĩnh vực này, Nhã Nam đã trở thành nhà xuất bản của những tác gia quan trọng trên thị trường xuất bản thế giới hiện nay: Đức Đạt Lai Lạt Ma, Deepak Chopra, Don Miguel Ruiz, Naomi Klein, Elisabeth Gilbert... </span></span></span></p>
                    <p><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Công ty Cổ phần Văn hóa và Truyền thông Nhã Nam đã được trao nhiều danh hiệu và giải thưởng như:</span></span></span></p>
                    <p><br>
                    <span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;"><strong>GIẢI THƯỞNG CHO DOANH NGHIỆP</strong></span></span></span></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2016: Bằng khen của Bộ trưởng Bộ TT&amp;TT cho tập thể đạt thành tích xuất sắc trong phong trào thi đua trong lĩnh vực xuất bản in và phát hành.</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">GIẢI THƯỞNG CHO CÁ NHÂN</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2018: Ngài Étienne Rolland-Piègue, Tham tán hợp tác và hoạt động văn hóa Đại sứ quán Pháp tại Việt Nam, đã trao tặng Huân chương Hiệp sĩ Văn học và Nghệ thuật cho ông Nguyễn Nhật Anh, Tổng Giám đốc Công ty Cổ phần Văn hóa và Truyền thông Nhã Nam.</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">GIẢI THƯỞNG CHO SÁCH</span></span></span></strong></p>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Sách Hay</span></span></span></strong></p>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2012</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Thiếu nhi: Chuyện con mèo dạy hải âu bay (Luis Sepúlveda, do Phương Huyên dịch).</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2013</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Thiếu nhi: Tottochan bên cửa sổ (Tetsuko Kuroyanagi, do Anh Thư dịch).</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2014</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Thiếu nhi: Bộ sách Nhóc Nicolas (Goscinny - Sempé, do Trác Phong, Hương Lan, Tố Châu dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Văn học: Bắt trẻ đồng xanh (J. D. Salinger, do Phùng Khánh dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Phát hiện mới: Ngàn năm áo mũ (Trần Quang Đức).</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2015</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Văn học: Những đứa con của nửa đêm (Salman Rushdie, do Nham Hoa dịch).</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2016</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Thiếu nhi: Chuyện con ốc sên muốn biết tại sao nó chậm chạp (Luis Sepúlveda, do Bảo Chân dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Sách cho người trẻ do Cộng đồng sách trẻ bình chọn (đây là một "hoạt động song song/hoạt động cộng đồng" của Giải Sách Hay 2016, không phải là một hạng mục giải thưởng): Bắt trẻ đồng xanh (J. D. Salinger, do Phùng Khánh dịch).</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2017</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Văn học: Bảo tàng ngây thơ (Orhan Pamuk, do Giáp Văn Chung dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Phát hiện mới: Mộ phần tuổi trẻ (Huỳnh Trọng Khang).</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2018</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Văn học: Chuyện ngõ nghèo (Nguyễn Xuân Khánh), Đời nhẹ khôn kham (Milan Kundera, do Trịnh Y Thư dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Phát hiện mới: Homo Deus: Lược sử tương lai (Yuval Noah Harari, do Dương Ngọc Trà dịch).</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2019</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Văn học: Vết nhơ của người (Philip Roth, do Phạm Viêm Phương và Huỳnh Kim Oanh dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Sách cho người trẻ do Cộng đồng sách trẻ bình chọn (đây là một "Hoạt động song song/hoạt động cộng đồng" của Giải Sách Hay 2019, không phải là một hạng mục giải thưởng):</span></span></span></li>
                        <li style="margin-bottom: 11px; margin-left: 40px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Nhà giả kim (Paulo Coelho, do Lê Chu Cầu dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; margin-left: 40px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hoàng tử bé (Antoine De Saint-Exupéry, do Trác Phong dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; margin-left: 40px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giết con chim nhại (Harper Lee, do Huỳnh Kim Oanh và Phạm Viêm Phương dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; margin-left: 40px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Bức xúc không làm ta vô can (Đặng Hoàng Giang).</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2020</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hạng mục Văn học: Chết chịu (Céline, do Dương Tường dịch).</span></span></span></li>
                    </ul>
                    <p style="margin-bottom: 11px; text-align: justify;">&nbsp;</p>
                    <p><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;"><strong>Giải Sách Quốc gia</strong><br>
                    <strong>2020</strong></span></span></span></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải C: Bộ sách Giáo dục đa giác quan (4 cuốn): Ú òa, sa mạc và nước xiết; Ú òa, rừng rậm và tuyết phủ; Ái chà, kỳ thú rừng xanh; Ái chà, bí mật vườn nhà. Tác giả: Pavla Hanácková. Minh họa: Linh Dao, Irene Gough. Người dịch: Hoàng My. NXB Hà Nội và Công ty Văn hóa và Truyền thông Nhã Nam liên kết xuất bản.</span></span></span></li>
                    </ul>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">2021</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải B: Tập thơ Bài thơ của một người yêu nước mình. Tác giả: Trần Vàng Sao. NXB Hà Nội và Công ty Văn hóa và Truyền thông Nhã Nam liên kết xuất bản.</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải B: Nghệ thuật Huế. Tác giả: Léopold Cadière. NXB Thế giới và Công ty Văn hóa và Truyền thông Nhã Nam liên kết xuất bản.</span></span></span></li>
                    </ul>
                    <p>&nbsp;</p>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải thưởng của Hội Nhà văn Việt Nam</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Văn học dịch, năm 2005: Cuộc đời của Pi (Yann Martel, do Trịnh Lữ dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Văn học dịch, năm 2008: Tên tôi là Đỏ (Orhan Pamuk, do Phạm Viêm Phương và Huỳnh Kim Anh dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Văn học dịch, năm 2016: Lâu đài sói (Hilary Mantel, do Nguyễn Chí Hoan dịch).</span></span></span></li>
                    </ul>
                    <p>&nbsp;</p>
                    <p><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải thưởng của Hội Nhà văn Hà Nội</span></span></span></strong></p>
                    <ul>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Văn học dịch, năm 2003-2004: Cuộc đời của Pi (Yann Martel, do Trịnh Lữ dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Thơ, năm 2007: Gửi V.B (Phan Thị Vàng Anh).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Văn học dịch, năm 2007: Biên niên ký chim vặn dây cót (Haruki Murakami, do Trần Tiễn Cao Đăng dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Văn học dịch, năm 2008: Nửa kia của Hitler (Éric-Emmanuel Schmitt, do Nguyễn Đình Thành dịch).</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Thành tựu trọn đời về thơ, năm 2008: Trần Dần - Thơ.</span></span></span></li>
                        <li style="margin-bottom: 11px; text-align: justify;"><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Giải Văn học dịch, năm 2020: 2666 (Roberto Bolaño, do Trần Tiễn Cao Đăng và Quân Khuê dịch).</span></span></span></li>
                    </ul>
                    <p>&nbsp;</p>
                    <ul></ul>
                    <p><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">***</span></span></span></p>
                    <p><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Hiểu thời đại đang sống thông qua sách, song hành với những biến chuyển sâu sắc trong lòng xã hội bằng những hoạt động xuất bản miệt mài và quả cảm, con đường Nhã Nam đã chọn để đi sẽ còn dài. Nhiều khó khăn, thử thách đang ở phía trước. Bước qua thời kỳ sơ khai với những bài học và những kinh nghiệm đầu tiên, Nhã Nam giờ đã sẵn sàng cho một chặng đường phát triển mới. Và chúng tôi muốn hoàn thiện mình trong sự cầu thị và cẩn trọng. Tất cả vì một gia sản sách to lớn, có sức sống dài lâu, có ý nghĩa với nhiều thế hệ bạn đọc.</span></span></span></p>
                    <p><em><strong><span style="margin-bottom:11px;text-align:justify;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Bởi vì sách là thế giới.</span></span></span></strong></em></p>
                    <p style="text-align: justify;">&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
@endsection 