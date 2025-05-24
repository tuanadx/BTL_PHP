<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use App\Models\Sach;
use App\Models\DonHang;
use App\Models\TacGia;
use App\Models\NhaXuatBan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng số khách hàng - chỉ đếm những người có role = 1
        $totalCustomers = KhachHang::where('role', 1)->count();

        // Tổng số sách
        $totalBooks = Sach::count();

        // Tổng số tác giả
        $totalAuthors = TacGia::count();

        // Tổng số nhà xuất bản
        $totalPublishers = NhaXuatBan::count();

        // Top khách hàng mua nhiều - chỉ lấy những người có role = 1
        $topCustomers = KhachHang::select('khach_hang.id', 'khach_hang.ho_ten', 'khach_hang.email', DB::raw('SUM(don_hang.tong_tien) as total_spent'))
            ->where('khach_hang.role', 1)
            ->join('don_hang', 'khach_hang.id', '=', 'don_hang.id_khach_hang')
            ->groupBy('khach_hang.id', 'khach_hang.ho_ten', 'khach_hang.email')
            ->orderBy('total_spent', 'desc')
            ->limit(5)
            ->get();

        // Sách bán chạy nhất
        $topBooks = Sach::select('sach.id', 'sach.ten_sach', 'sach.anh', 'sach.gia_tien',
                DB::raw('SUM(chi_tiet_don_hang.so_luong) as total_sold'),
                DB::raw('SUM(chi_tiet_don_hang.so_luong * chi_tiet_don_hang.don_gia) as total_revenue'))
            ->join('chi_tiet_don_hang', 'sach.id', '=', 'chi_tiet_don_hang.sach_id')
            ->groupBy('sach.id', 'sach.ten_sach', 'sach.anh', 'sach.gia_tien')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers', 
            'totalBooks', 
            'totalAuthors',
            'totalPublishers',
            'topCustomers', 
            'topBooks'
        ));
    }
} 