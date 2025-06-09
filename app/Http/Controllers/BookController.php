<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;

class BookController extends Controller
{
    public function detail($id)
    {
        $book = Sach::findOrFail($id);
        
        // Lấy sách liên quan theo quốc gia
        $relatedBooks = Sach::where('ma_quoc_gia', $book->ma_quoc_gia)
            ->where('id', '!=', $book->id) // Loại bỏ sách hiện tại
            ->limit(5) // Giới hạn 5 sách liên quan
            ->get();
        
        return view('books.detail', [
            'title' => $book->tensach,
            'book' => $book,
            'relatedBooks' => $relatedBooks
        ]);
    }
} 