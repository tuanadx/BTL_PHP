@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý khách hàng</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->ho_ten }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->so_dien_thoai }}</td>
                            <td>{{ $customer->dia_chi }}</td>
                            <td>
                                <span class="badge badge-{{ $customer->trang_thai ? 'success' : 'danger' }}">
                                    {{ $customer->trang_thai ? 'Hoạt động' : 'Khóa' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.customers.toggle-status', $customer->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-{{ $customer->trang_thai ? 'warning' : 'success' }} btn-sm">
                                        <i class="fas fa-{{ $customer->trang_thai ? 'lock' : 'unlock' }}"></i>
                                        {{ $customer->trang_thai ? 'Khóa' : 'Mở khóa' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa? Chỉ có thể xóa khách hàng chưa có đơn hàng.')">
                                        <i class="fas fa-trash"></i>
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection 