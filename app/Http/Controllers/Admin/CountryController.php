<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuocGia;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function index()
    {
        $countries = QuocGia::paginate(10);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_quoc_gia' => 'required|string|max:255',
        ], [
            'ten_quoc_gia.required' => 'Tên quốc gia không được để trống',
        ]);

        // Tự động tạo mã quốc gia từ tên
        $maQuocGia = 'QG' . str_pad(QuocGia::count() + 1, 3, '0', STR_PAD_LEFT);
        
        QuocGia::create([
            'ma_quoc_gia' => $maQuocGia,
            'ten_quoc_gia' => $request->ten_quoc_gia
        ]);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Thêm quốc gia mới thành công');
    }

    public function edit($ma_quoc_gia)
    {
        $country = QuocGia::where('ma_quoc_gia', $ma_quoc_gia)->firstOrFail();
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, $ma_quoc_gia)
    {
        $request->validate([
            'ten_quoc_gia' => 'required|string|max:255',
        ], [
            'ten_quoc_gia.required' => 'Tên quốc gia không được để trống',
        ]);

        $country = QuocGia::where('ma_quoc_gia', $ma_quoc_gia)->firstOrFail();
        $country->update([
            'ten_quoc_gia' => $request->ten_quoc_gia
        ]);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Cập nhật quốc gia thành công');
    }

    public function destroy($ma_quoc_gia)
    {
        $country = QuocGia::where('ma_quoc_gia', $ma_quoc_gia)->firstOrFail();
        $country->delete();

        return redirect()->route('admin.countries.index')
            ->with('success', 'Xóa quốc gia thành công');
    }
} 