<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\QuocGia;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Sử dụng Bootstrap cho phân trang
        Paginator::useBootstrap();
        
        $perPage = 8; // Số sách mỗi trang
        $query = Sach::query();
        
        // Lọc theo quốc gia nếu có
        if ($request->has('country') && !empty($request->country)) {
            $query->whereIn('ma_quoc_gia', (array)$request->country);
        }

        // Xử lý sắp xếp
        $sortType = $request->get('sort', '');
        switch ($sortType) {
            case 'newest':
                $query->orderBy('ngay_phat_hanh', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('gia_tien', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('gia_tien', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc'); // Mặc định sắp xếp theo ID mới nhất
                break;
        }
        
        $books = $query->paginate($perPage)->onEachSide(1);
        $countries = QuocGia::all(); // Lấy danh sách quốc gia
        
        if ($request->ajax()) {
            return view('home.index', [
                'title' => 'Trang chủ',
                'books' => $books,
                'countries' => $countries,
                'selectedCountries' => (array)$request->country,
                'sortType' => $sortType
            ])->render();
        }
        
        return view('home.index', [
            'title' => 'Trang chủ',
            'books' => $books,
            'countries' => $countries,
            'selectedCountries' => (array)$request->country,
            'sortType' => $sortType
        ]);
    }
}
