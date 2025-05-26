<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    use HasFactory;
    
    /**
     * Tên bảng liên kết với model
     *
     * @var string
     */
    protected $table = 'sach';
    
    /**
     * Tắt tính năng timestamps
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * Các thuộc tính có thể gán hàng loạt
     *
     * @var array
     */
    protected $fillable = [
        'ten_sach',
        'gia_tien',
        'id_tac_gia',
        'ma_quoc_gia',
        'ma_nxb',
        'so_luong',
        'anh',
        'ngay_phat_hanh',
        'gioi_thieu'
    ];
    
    /**
     * Lấy các chi tiết giỏ hàng chứa sách này
     */
    public function chiTietGioHang()
    {
        return $this->hasMany(ChiTietGioHang::class, 'id_sach', 'id');
    }

    /**
     * Lấy thông tin tác giả của sách
     */
    public function tacGia()
    {
        return $this->belongsTo(TacGia::class, 'id_tac_gia', 'id');
    }

    /**
     * Lấy thông tin quốc gia của sách
     */
    public function quocGia()
    {
        return $this->belongsTo(QuocGia::class, 'ma_quoc_gia', 'ma_quoc_gia');
    }

    /**
     * Lấy thông tin nhà xuất bản của sách
     */
    public function nhaXuatBan()
    {
        return $this->belongsTo(NhaXuatBan::class, 'ma_nxb', 'ma_nxb');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_sach');
    }
}
