<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\TacGia;
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
        
        // Lấy danh sách quốc gia
        $countries = QuocGia::all();
        $selectedCountries = $request->get('country', []);

        // Lọc theo quốc gia nếu có
        if (!empty($selectedCountries)) {
            $query->whereIn('ma_quoc_gia', $selectedCountries);
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
        
        // Lấy danh sách tác giả cho slider
        $authors = TacGia::limit(6)->get();
        
        if ($request->ajax()) {
            return view('home.index', [
                'title' => 'Trang chủ',
                'books' => $books,
                'countries' => $countries,
                'selectedCountries' => $selectedCountries,
                'sortType' => $sortType,
                'authors' => $authors
            ])->render();
        }
        
        return view('home.index', [
            'title' => 'Trang chủ',
            'books' => $books,
            'countries' => $countries,
            'selectedCountries' => $selectedCountries,
            'sortType' => $sortType,
            'authors' => $authors
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function stores()
    {
        return view('stores');
    }
}
