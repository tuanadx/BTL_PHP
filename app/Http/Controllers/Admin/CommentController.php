<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['khachHang', 'sach'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.comments.index', compact('comments'));
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            
            return redirect()->route('admin.comments.index')
                ->with('success', 'Xóa bình luận thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.comments.index')
                ->with('error', 'Có lỗi xảy ra khi xóa bình luận');
        }
    }
} 