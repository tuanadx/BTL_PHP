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
                <li class="active">Hệ thống hiệu sách</li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="container">
            <h1 class="title-module">Hệ thống hiệu sách</h1>

    <section class="page">
        <div class="container margin-top-20 margin-bottom-20">
           
            <div class="cssload-loader" style="display: none;">
                <ul class="loading-animation" hidden>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <ul class="loading-animation alternate">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <div class="sectionContentStore row">
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="leftCollumStore">
                        <div class="resultStore">
                            <div id="list-store">
                                <div class="item o checked" data-code="<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9235014211913!2d105.78027207591815!3d21.03574668753735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4ab82e8a2d%3A0xe52fd6b755ba654c!2zMjQxIFh1w6JuIFRo4buneSwgROG7i2NoIFbhu41uZyBI4bqtdSwgQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1697618323222!5m2!1svi!2s' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>">
                                    <div class="district">Cầu Giấy</div>
                                    <p>Tầng 3, TTTM IPH, 241 Xuân Thủy, Cầu Giấy, Hà Nội - ĐT: 0246.659.4535</p>
                                </div>
                                <div class="item o" data-code="<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.551611553289!2d105.80011737584103!3d21.010603588400805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aca0f551d919%3A0xdb37e452a9a3828f!2zQ8O0bmcgVHkgVsSDbiBIw7NhIFRydXnhu4FuIFRow7RuZyBOaMOjIE5hbQ!5e0!3m2!1svi!2s!4v1704687922193!5m2!1svi!2s' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>">
                                    <div class="district">Cầu Giấy</div>
                                    <p>59 Đỗ Quang, Trung Hòa, Cầu Giấy, Hà Nội - ĐT: 0243.514.6875</p>
                                </div>
                                <!-- Add more store items here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-8">
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9235014211913!2d105.78027207591815!3d21.03574668753735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4ab82e8a2d%3A0xe52fd6b755ba654c!2zMjQxIFh1w6JuIFRo4buneSwgROG7i2NoIFbhu41uZyBI4bqtdSwgQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1697618323222!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@push('scripts')
<script>
$(document).ready(function() {
    // Handle store selection
    $('#list-store .item').click(function() {
        var $this = $(this);
        if (!$this.hasClass('unclick')) {
            $this.siblings().removeClass('checked');
            $this.addClass('checked');
            var code = $this.data('code');
            generateMap(code);
        }
    });

    // Handle city selection
    $('.select-city').change(function() {
        var selectedCity = $(this).val();
        // Here you would typically make an AJAX call to get stores for the selected city
        // For now, we'll just show the first store as default
        var $firstStore = $('#list-store .item').first();
        $firstStore.addClass('checked');
        generateMap($firstStore.data('code'));
    });

    function generateMap(code) {
        $('#map').html(code);
    }
});
</script>
@endpush

@endsection 