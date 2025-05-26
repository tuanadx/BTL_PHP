@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quản lý khách hàng</h3>
            <div class="card-tools">
                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Thêm khách hàng
                </a>
            </div>
        </div>
        <div class="card-body">
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

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->ho_ten }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->so_dien_thoai }}</td>
                            <td>{{ $customer->dia_chi }}</td>
                            <td>
                                <span class="badge badge-{{ $customer->trang_thai ? 'success' : 'danger' }}" style="{{ $customer->trang_thai ? 'color: #28a745; background-color: #d4edda; border-color: #c3e6cb;' : '' }}">
                                    {{ $customer->trang_thai ? 'Đang hoạt động' : 'Đã khóa' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.customers.show', $customer->id) }}" 
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Chi tiết
                                </a>
                                <a href="{{ route('admin.customers.edit', $customer->id) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 