<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\TacGia;
use App\Models\NhaXuatBan;
use App\Models\QuocGia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index()
    {
        $books = Sach::with(['tacGia', 'nhaXuatBan'])->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $tacGias = TacGia::all();
        $nhaXuatBans = NhaXuatBan::all();
        $quocGias = QuocGia::all();
        return view('admin.books.create', compact('tacGias', 'nhaXuatBans', 'quocGias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_sach' => 'required|string|max:255',
            'gia_tien' => 'required|numeric|min:0',
            'id_tac_gia' => 'nullable|exists:tac_gia,id',
            'ma_nxb' => 'nullable|exists:nha_xuat_ban,ma_nxb',
            'ma_quoc_gia' => 'nullable|exists:quoc_gia,ma_quoc_gia',
            'ngay_phat_hanh' => 'nullable|date',
            'gioi_thieu' => 'nullable|string',
            'so_luong' => 'required|integer|min:0',
            'anh' => 'nullable|image|max:2048'
        ]);

        $data = $request->only([
            'ten_sach',
            'gia_tien',
            'id_tac_gia',
            'ma_nxb',
            'ma_quoc_gia',
            'gioi_thieu',
            'so_luong'
        ]);

        // Nếu không có ngày phát hành, sử dụng ngày hiện tại
        $data['ngay_phat_hanh'] = $request->ngay_phat_hanh ?? Carbon::now()->format('Y-m-d');

        if ($request->hasFile('anh')) {
            $file = $request->file('anh');
            $fileName = time() . '_' . Str::slug($request->ten_sach) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('/', $fileName, 'public');
            $data['anh'] = $path;
        }

        Sach::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Thêm sách mới thành công');
    }

    public function edit($id)
    {
        $book = Sach::findOrFail($id);
        $tacGias = TacGia::all();
        $nhaXuatBans = NhaXuatBan::all();
        $quocGias = QuocGia::all();
        return view('admin.books.edit', compact('book', 'tacGias', 'nhaXuatBans', 'quocGias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_sach' => 'required|string|max:255',
            'gia_tien' => 'required|numeric|min:0',
            'id_tac_gia' => 'nullable|exists:tac_gia,id',
            'ma_nxb' => 'nullable|exists:nha_xuat_ban,ma_nxb',
            'ma_quoc_gia' => 'nullable|exists:quoc_gia,ma_quoc_gia',
            'ngay_phat_hanh' => 'nullable|date',
            'gioi_thieu' => 'nullable|string',
            'so_luong' => 'required|integer|min:0',
            'anh' => 'nullable|image|max:2048'
        ]);

        $book = Sach::findOrFail($id);
        $data = $request->only([
            'ten_sach',
            'gia_tien',
            'id_tac_gia',
            'ma_nxb',
            'ma_quoc_gia',
            'gioi_thieu',
            'so_luong'
        ]);

        // Nếu không có ngày phát hành, sử dụng ngày hiện tại
        $data['ngay_phat_hanh'] = $request->ngay_phat_hanh ?? Carbon::now()->format('Y-m-d');

        if ($request->hasFile('anh')) {
            // Xóa ảnh cũ nếu có
            if ($book->anh) {
                Storage::disk('public')->delete($book->anh);
            }
            
            $file = $request->file('anh');
            $fileName = time() . '_' . Str::slug($request->ten_sach) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('/', $fileName, 'public');
            $data['anh'] = $path;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Cập nhật sách thành công');
    }

    public function destroy($id)
    {
        $book = Sach::findOrFail($id);
        
        // Xóa ảnh nếu có
        if ($book->anh) {
            Storage::disk('public')->delete($book->anh);
        }
        
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Xóa sách thành công');
    }
} 