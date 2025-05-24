<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    use HasFactory;
    
    /**
     * Tên bảng liên kết với model
     *
     * @var string
     */
    protected $table = 'chi_tiet_gio_hang';
    
    /**
     * Các thuộc tính có thể gán hàng loạt
     *
     * @var array
     */
    protected $fillable = [
        'id_gio_hang',
        'id_sach',
        'so_luong',
        'gia_tien'
    ];
    
    /**
     * Tự động tính toán thanh_tien khi cập nhật
     *
     * @var array
     */
    protected $appends = ['thanh_tien'];
    
    /**
     * Lấy giỏ hàng chứa chi tiết này
     */
    public function gioHang()
    {
        return $this->belongsTo(GioHang::class, 'id_gio_hang', 'id');
    }
    
    /**
     * Lấy sách liên quan
     */
    public function sach()
    {
        return $this->belongsTo(Sach::class, 'id_sach', 'id');
    }
    
    /**
     * Tính toán thanh_tien
     */
    public function getThanhTienAttribute()
    {
        return $this->so_luong * $this->gia_tien;
    }
}
