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

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $perPage = 8;
        $query = \App\Models\Sach::query()->with(['tacGia', 'nhaXuatBan']);
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('ten_sach', 'like', "%$keyword%")
                  ->orWhereHas('tacGia', function($q2) use ($keyword) {
                      $q2->where('ten_tac_gia', 'like', "%$keyword%") ;
                  })
                  ->orWhereHas('nhaXuatBan', function($q3) use ($keyword) {
                      $q3->where('ten_nxb', 'like', "%$keyword%") ;
                  });
            });
        }
        $books = $query->paginate($perPage)->appends(['keyword' => $keyword]);
        return view('home.search', compact('books', 'keyword'));
    }
}
