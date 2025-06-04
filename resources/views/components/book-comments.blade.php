@props(['book'])

<div class="comments-section">
    <h3 class="section-title">Bình luận</h3>

    @auth('khach_hang')
        <form action="{{ route('comments.store') }}" method="POST" class="comment-form">
            @csrf
            <input type="hidden" name="id_sach" value="{{ $book->id }}">
            <div class="form-group">
                <textarea name="comment" class="comment-input" rows="3" placeholder="Viết bình luận của bạn..." required></textarea>
            </div>
            <div class="text-right">
                <button type="submit" class="btn-comment">Gửi bình luận</button>
            </div>
        </form>
    @else
        <div class="alert-info">
            Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận
        </div>
    @endauth

    <div class="comments-list">
        @forelse($book->comments as $comment)
            <div class="comment-item">
                <div class="comment-header">
                    <div class="comment-author">
                        <div class="avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span>{{ $comment->khachHang->ten_khach_hang }}</span>
                    </div>
                    <div class="comment-date">
                        {{ $comment->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="comment-text">
                    {{ $comment->comment }}
                </div>
                @auth('khach_hang')
                    @if(auth('khach_hang')->id() == $comment->id_khach_hang)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="text-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Xóa</button>
                        </form>
                    @endif
                @endauth
            </div>
        @empty
            <div class="alert-info">
                Chưa có bình luận nào. Hãy là người đầu tiên bình luận!
            </div>
        @endforelse
    </div>
</div>

<style>
.comments-section {
    margin-top: 30px;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.section-title {
    color: #2F5A33;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #2F5A33;
}

.comment-form {
    margin-bottom: 30px;
}

.comment-input {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 12px;
    resize: none;
    margin-bottom: 10px;
}

.comment-input:focus {
    border-color: #2F5A33;
    box-shadow: 0 0 0 0.2rem rgba(47, 90, 51, 0.25);
    outline: none;
}

.btn-comment {
    background-color: #2F5A33;
    color: #fff;
    padding: 8px 20px;
    border: none;
    border-radius: 4px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-comment:hover {
    background-color: #1e3b21;
}

.comments-list {
    max-height: 500px;
    overflow-y: auto;
    padding-right: 10px;
}

.comment-item {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 15px;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.comment-author {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #2F5A33;
    font-weight: 600;
}

.avatar {
    width: 40px;
    height: 40px;
    background-color: #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2F5A33;
}

.comment-date {
    color: #6c757d;
    font-size: 0.9em;
}

.comment-text {
    color: #333;
    margin-bottom: 10px;
    line-height: 1.5;
}

.btn-delete {
    background: none;
    border: none;
    color: #dc3545;
    cursor: pointer;
    padding: 0;
    font-size: 14px;
}

.btn-delete:hover {
    text-decoration: underline;
}

.alert-info {
    background-color: #f8f9fa;
    border: 1px solid #2F5A33;
    color: #2F5A33;
    padding: 15px;
    border-radius: 4px;
    text-align: center;
}

.alert-info a {
    color: #2F5A33;
    font-weight: 600;
    text-decoration: none;
}

.alert-info a:hover {
    text-decoration: underline;
}

.text-right {
    text-align: right;
}
</style> 