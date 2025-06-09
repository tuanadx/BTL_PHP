<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <title>{{ isset($title) ? $title : 'Nhà sách online' }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Main CSS -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Detail CSS -->
    <link href="{{ asset('css/detail.css') }}" rel="stylesheet">
    <!-- Cart CSS -->
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <!-- News CSS -->
    <link href="{{ asset('css/news.css') }}" rel="stylesheet">
    <!-- Home Sections CSS -->
    <link href="{{ asset('css/home-sections.css') }}" rel="stylesheet">
    <!-- Static Pages CSS -->
    <link href="{{ asset('css/static-pages.css') }}" rel="stylesheet">
    <!-- Login CSS -->
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Base URL for JavaScript -->
    <script>
        const baseUrl = '{{ url('/') }}';
    </script>
    <!-- Component specific styles -->
    @stack('styles')
</head>
<body>
    @include('includes.header')

    <main>
        @yield('content')
    </main>

    @include('includes.footer')

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- App JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Dropdown JavaScript -->
    <script src="{{ asset('js/dropdown.js') }}"></script>
    <!-- Component specific scripts -->
    @stack('scripts')
</body>
</html> 