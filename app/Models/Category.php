<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Pastikan ini sesuai dengan nama kolom di tabel categories database kamu
    protected $fillable = ['nama_kategori'];

    /**
     * Relasi ke Model Book (Satu kategori memiliki banyak buku)
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
