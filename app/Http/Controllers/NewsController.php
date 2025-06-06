<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($slug)
    {
        // Map slug to view file
        $viewMap = [
            'nhanam' => 'news.nhanam',
            'ai-doc-cung-ta' => 'news.ai_doc_cung_ta',
            'review-bao-chi' => 'news.review_bao_chi',
            'reader-reviews' => 'news.reader_reviews',
            'editor-recommendations' => 'news.editor_recommendations'
        ];

        // Check if slug exists in map
        if (!isset($viewMap[$slug])) {
            abort(404);
        }

        // Return the corresponding view
        return view($viewMap[$slug]);
    }
}
