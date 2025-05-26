<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_sach' => 'required|exists:sach,id',
            'comment' => 'required|string|max:1000'
        ], [
            'comment.required' => 'Nội dung bình luận không được để trống',
            'comment.max' => 'Nội dung bình luận không được vượt quá 1000 ký tự'
        ]);

        $userId = Auth::guard('khach_hang')->id();

        $comment = Comment::create([
            'id_khach_hang' => $userId,
            'id_sach' => $request->id_sach,
            'comment' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'created_at' => $comment->created_at->format('d/m/Y H:i'),
                'khach_hang' => [
                    'ho_ten' => Auth::guard('khach_hang')->user()->ho_ten
                ]
            ]
        ]);
    }
} 