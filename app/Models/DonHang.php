<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'don_hang';

    protected $fillable = [
        'id_khach_hang',
        'ngay_dat_hang',
        'tong_tien',
        'trang_thai',
        'trang_thai_thanh_toan',
        'dia_chi',
        'ghi_chu',
        'sdt_nguoi_nhan'
    ];

    protected $casts = [
        'ngay_dat_hang' => 'datetime',
        'tong_tien' => 'decimal:2'
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'id_khach_hang');
    }

    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }
}
