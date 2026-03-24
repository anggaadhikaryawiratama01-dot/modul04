<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar data bisa disimpan
    protected $fillable = [
        'category_id',
        'judul',
        'penulis',
        'tahun_terbit',
        'stok',
        'cover'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
