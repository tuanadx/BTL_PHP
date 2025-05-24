<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Admin Panel</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link align-middle px-0 text-white">
                                <i class="fas fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="fas fa-book"></i> <span class="ms-1 d-none d-sm-inline">Quản lý sách</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.books.index') }}" class="nav-link px-0 text-white">
                                        <i class="fas fa-list"></i> <span class="d-none d-sm-inline">Thông tin sách</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.books.create') }}" class="nav-link px-0 text-white">
                                        <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Thêm sách mới</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="fas fa-user-edit"></i> <span class="ms-1 d-none d-sm-inline">Quản lý tác giả</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.authors.index') }}" class="nav-link px-0 text-white">
                                        <i class="fas fa-list"></i> <span class="d-none d-sm-inline">Danh sách tác giả</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.authors.create') }}" class="nav-link px-0 text-white">
                                        <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Thêm tác giả mới</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="fas fa-building"></i> <span class="ms-1 d-none d-sm-inline">Quản lý NXB</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.publishers.index') }}" class="nav-link px-0 text-white">
                                        <i class="fas fa-list"></i> <span class="d-none d-sm-inline">Danh sách NXB</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.publishers.create') }}" class="nav-link px-0 text-white">
                                        <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Thêm NXB mới</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="fas fa-globe"></i> <span class="ms-1 d-none d-sm-inline">Quản lý quốc gia</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.countries.index') }}" class="nav-link px-0 text-white">
                                        <i class="fas fa-list"></i> <span class="d-none d-sm-inline">Danh sách quốc gia</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.countries.create') }}" class="nav-link px-0 text-white">
                                        <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Thêm quốc gia mới</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.customers.index') }}" class="nav-link px-0 align-middle text-white">
                                <i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Quản lý khách hàng</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link px-0 align-middle text-white">
                                <i class="fas fa-shopping-cart"></i> <span class="ms-1 d-none d-sm-inline">Quản lý đơn hàng</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col py-3">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 