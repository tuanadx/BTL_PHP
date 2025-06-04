<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function nhanam()
    {
        return view('news.nhanam');
    }
}
