<?php

namespace App\Http\Controllers;

use App\Models\TacGia;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $authors = TacGia::paginate(12);
        return view('authors.index', compact('authors'));
    }

    public function show($id)
    {
        $author = TacGia::findOrFail($id);
        return view('authors.show', compact('author'));
    }
} 