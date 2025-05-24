<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacGia extends Model
{
    use HasFactory;
    
    /**
     * Tên bảng liên kết với model
     *
     * @var string
     */
    protected $table = 'tac_gia';
    
    /**
     * Vô hiệu hóa timestamps
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
        'ten_tac_gia',
        'email',
        'sdt',
        'dia_chi',
        'mo_ta'
    ];
    
    /**
     * Lấy các sách của tác giả
     */
    public function sachs()
    {
        return $this->hasMany(Sach::class, 'id_tac_gia', 'id');
    }
} 