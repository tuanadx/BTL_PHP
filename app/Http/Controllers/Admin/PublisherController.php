<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhaXuatBan;
use Illuminate\Support\Str;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = NhaXuatBan::paginate(10);
        return view('admin.publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('admin.publishers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_nxb' => 'required|string|max:255',
            'dia_chi' => 'required|string',
            'email' => 'required|email',
            'sdt' => 'required|string|max:20'
        ], [
            'ten_nxb.required' => 'Tên nhà xuất bản không được để trống',
            'dia_chi.required' => 'Địa chỉ không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'sdt.required' => 'Số điện thoại không được để trống'
        ]);

        NhaXuatBan::create($request->all());

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Thêm nhà xuất bản mới thành công');
    }

    public function edit($id)
    {
        $publisher = NhaXuatBan::findOrFail($id);
        return view('admin.publishers.edit', compact('publisher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_nxb' => 'required|string|max:255',
            'dia_chi' => 'required|string',
            'email' => 'required|email',
            'sdt' => 'required|string|max:20'
        ], [
            'ten_nxb.required' => 'Tên nhà xuất bản không được để trống',
            'dia_chi.required' => 'Địa chỉ không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'sdt.required' => 'Số điện thoại không được để trống'
        ]);

        $publisher = NhaXuatBan::findOrFail($id);
        $publisher->update($request->all());

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Cập nhật nhà xuất bản thành công');
    }

    public function destroy($id)
    {
        $publisher = NhaXuatBan::findOrFail($id);
        $publisher->delete();

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Xóa nhà xuất bản thành công');
    }
} 