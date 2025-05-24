<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaXuatBan extends Model
{
    use HasFactory;

    protected $table = 'nha_xuat_ban';
    protected $primaryKey = 'ma_nxb';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ten_nxb',
        'email',
        'sdt',
        'dia_chi'
    ];

    public function sachs()
    {
        return $this->hasMany(Sach::class, 'ma_nxb', 'ma_nxb');
    }
} 