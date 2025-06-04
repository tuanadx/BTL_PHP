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
                        <div class="author-info">
                            <span class="author-name">{{ $comment->khachHang->ho_ten }}</span>
                            <span class="author-role">Khách hàng</span>
                        </div>
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
                        <div class="text-right">
                            <button type="button" class="btn-delete" onclick="showDeleteConfirm('{{ $comment->id }}')">Xóa</button>
                        </div>
                        <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
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

<!-- Modal Xác nhận xóa -->
<div id="deleteConfirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Xác nhận xóa</h4>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <p>Bạn có chắc chắn muốn xóa bình luận này?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel">Hủy</button>
            <button type="button" class="btn-confirm">Xóa</button>
        </div>
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

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 0;
    border-radius: 8px;
    width: 400px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    animation: modalFadeIn 0.3s;
}

@keyframes modalFadeIn {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
}

.modal-header {
    padding: 15px 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h4 {
    margin: 0;
    color: #2F5A33;
    font-size: 18px;
}

.close {
    color: #aaa;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: #333;
}

.modal-body {
    padding: 20px;
    text-align: center;
}

.modal-footer {
    padding: 15px 20px;
    border-top: 1px solid #eee;
    text-align: right;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-cancel {
    background-color: #6c757d;
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background-color: #5a6268;
}

.btn-confirm {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-confirm:hover {
    background-color: #c82333;
}

.author-info {
    display: flex;
    flex-direction: column;
}

.author-name {
    font-weight: 600;
    color: #2F5A33;
}

.author-role {
    font-size: 0.8em;
    color: #6c757d;
}
</style>

<script>
let currentCommentId = null;
const modal = document.getElementById('deleteConfirmModal');
const closeBtn = document.getElementsByClassName('close')[0];
const cancelBtn = document.getElementsByClassName('btn-cancel')[0];
const confirmBtn = document.getElementsByClassName('btn-confirm')[0];

function showDeleteConfirm(commentId) {
    currentCommentId = commentId;
    modal.style.display = 'block';
}

function closeModal() {
    modal.style.display = 'none';
    currentCommentId = null;
}

function confirmDelete() {
    if (currentCommentId) {
        document.getElementById('delete-form-' + currentCommentId).submit();
    }
}

closeBtn.onclick = closeModal;
cancelBtn.onclick = closeModal;
confirmBtn.onclick = confirmDelete;

window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}
</script> 