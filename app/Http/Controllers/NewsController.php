<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function nhanam()
    {
        return view('news.nhanam');
    }

    public function readerReviews()
    {
        // We'll add logic to fetch and paginate reviews here later
        // For now, return the view
        return view('news.reader_reviews');
    }
}
