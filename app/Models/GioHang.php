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
     * Cập nhật tổng tiền trong giỏ hàng bao gồm VAT và phí vận chuyển
     */
    public function capNhatTongTien()
    {
        $subTotal = $this->chiTietGioHang->sum('thanh_tien');
        $vat = $subTotal * 0.1; // VAT 10%
        $shipping = $subTotal >= 500000 ? 0 : 30000; // Miễn phí vận chuyển cho đơn hàng từ 500k
        
        $this->tong_tien = $subTotal + $vat + $shipping;
        $this->save();
        
        return $this;
    }
}
