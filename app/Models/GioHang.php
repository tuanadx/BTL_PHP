<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;
    
    /**
     * Tên bảng liên kết với model
     *
     * @var string
     */
    protected $table = 'gio_hang';
    
    /**
     * Tên trường created_at và updated_at
     */
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    
    /**
     * Các thuộc tính có thể gán hàng loạt
     *
     * @var array
     */
    protected $fillable = [
        'id_khach_hang',
        'tong_tien',
        'trang_thai',
        'ghi_chu'
    ];
    
    /**
     * Lấy khách hàng sở hữu giỏ hàng
     */
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'id_khach_hang', 'id');
    }
    
    /**
     * Lấy các chi tiết giỏ hàng
     */
    public function chiTietGioHang()
    {
        return $this->hasMany(ChiTietGioHang::class, 'id_gio_hang', 'id');
    }
    
    /**
     * Cập nhật tổng tiền trong giỏ hàng
     */
    public function capNhatTongTien()
    {
        $this->tong_tien = $this->chiTietGioHang->sum('thanh_tien');
        $this->save();
        
        return $this;
    }
}
