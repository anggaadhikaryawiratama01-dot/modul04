<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'judul',
        'penulis',
        'tahun_terbit',
        'stok',
        'cover', // Tambahkan ini untuk mengizinkan penyimpanan nama file gambar
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
