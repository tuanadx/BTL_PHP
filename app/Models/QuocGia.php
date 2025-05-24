<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuocGia extends Model
{
    use HasFactory;

    protected $table = 'quoc_gia';
    protected $primaryKey = 'ma_quoc_gia';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ma_quoc_gia',
        'ten_quoc_gia'
    ];

    public function sachs()
    {
        return $this->hasMany(Sach::class, 'ma_quoc_gia', 'ma_quoc_gia');
    }
} 