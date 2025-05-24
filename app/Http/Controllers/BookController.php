<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;

class BookController extends Controller
{
    public function detail($id)
    {
        $book = Sach::findOrFail($id);
        
        return view('books.detail', [
            'title' => $book->tensach,
            'book' => $book
        ]);
    }
} 