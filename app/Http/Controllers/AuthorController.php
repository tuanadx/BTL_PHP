<?php

namespace App\Http\Controllers;

use App\Models\TacGia;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return view('authors.index');
    }

    public function show($id)
    {
        $author = TacGia::findOrFail($id);
        return view('authors.show', compact('author'));
    }
} 