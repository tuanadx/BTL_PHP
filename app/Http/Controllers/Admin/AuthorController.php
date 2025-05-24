<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TacGia;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = TacGia::paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_tac_gia' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'sdt' => 'nullable|string|max:20',
            'dia_chi' => 'nullable|string',
            'mo_ta' => 'nullable|string'
        ]);

        TacGia::create($request->all());

        return redirect()->route('admin.authors.index')
            ->with('success', 'Thêm tác giả thành công');
    }

    public function edit($id)
    {
        $author = TacGia::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_tac_gia' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'sdt' => 'nullable|string|max:20',
            'dia_chi' => 'nullable|string',
            'mo_ta' => 'nullable|string'
        ]);

        $author = TacGia::findOrFail($id);
        $author->update($request->all());

        return redirect()->route('admin.authors.index')
            ->with('success', 'Cập nhật tác giả thành công');
    }

    public function destroy($id)
    {
        $author = TacGia::findOrFail($id);
        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Xóa tác giả thành công');
    }
} 