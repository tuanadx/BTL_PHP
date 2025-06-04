<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Lưu bình luận mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'id_sach' => 'required|exists:sach,id'
        ], [
            'comment.required' => 'Nội dung bình luận không được để trống',
            'comment.max' => 'Nội dung bình luận không được vượt quá 1000 ký tự',
            'id_sach.required' => 'Không tìm thấy sách',
            'id_sach.exists' => 'Sách không tồn tại'
        ]);

        $comment = Comment::create([
            'id_khach_hang' => Auth::guard('khach_hang')->id(),
            'id_sach' => $request->id_sach,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Bình luận đã được thêm thành công!');
    }

    /**
     * Xóa bình luận
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Kiểm tra xem người dùng có quyền xóa bình luận không
        if ($comment->id_khach_hang !== Auth::guard('khach_hang')->id()) {
            return back()->with('error', 'Bạn không có quyền xóa bình luận này!');
        }

        $comment->delete();
        return back()->with('success', 'Bình luận đã được xóa!');
    }
} 