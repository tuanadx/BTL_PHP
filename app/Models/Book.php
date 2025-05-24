<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'sach'; // Tên bảng trong database
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author',
        'price',
        'description',
        'image',
        'quantity',
        'category_id'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'book_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
} 