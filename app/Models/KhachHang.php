<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHang extends Authenticatable
{
    use HasFactory;
    
    /**
     * Tên bảng liên kết với model
     *
     * @var string
     */
    protected $table = 'khach_hang';
    
    /**
     * Các thuộc tính có thể gán hàng loạt
     *
     * @var array
     */
    protected $fillable = [
        'ho_ten',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'dia_chi',
        'ngay_sinh',
        'gioi_tinh',
        'trang_thai'
    ];
    
    /**
     * Các thuộc tính bảo mật
     *
     * @var array
     */
    protected $hidden = [
        'mat_khau',
    ];
    
    /**
     * Lấy các giỏ hàng của khách hàng
     */
    public function gioHang()
    {
        return $this->hasMany(GioHang::class, 'id_khach_hang', 'id');
    }
    
    /**
     * Lấy giỏ hàng hiện tại của khách hàng
     */
    public function gioHangHienTai()
    {
        return $this->hasOne(GioHang::class, 'id_khach_hang', 'id')
            ->where('trang_thai', 'active')
            ->latest();
    }
    
    /**
     * Đổi tên trường mật khẩu
     */
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    public $timestamps = false;

    protected $casts = [
        'ngay_sinh' => 'date',
        'ngay_dang_ky' => 'datetime',
        'trang_thai' => 'boolean'
    ];

    public function donHang()
    {
        return $this->hasMany(DonHang::class, 'id_khach_hang');
    }
}
