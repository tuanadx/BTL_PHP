<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_don_hang';

    protected $fillable = [
        'don_hang_id',
        'sach_id',
        'so_luong',
        'don_gia'
    ];

    protected $casts = [
        'don_gia' => 'decimal:0'
    ];

    protected $appends = ['thanh_tien'];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }

    public function sach()
    {
        return $this->belongsTo(Sach::class, 'sach_id');
    }

    public function getThanhTienAttribute()
    {
        return $this->so_luong * $this->don_gia;
    }
}
