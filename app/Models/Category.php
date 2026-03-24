<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tambahkan 'deskripsi' ke dalam array fillable agar bisa disimpan ke database
    protected $fillable = ['nama_kategori', 'deskripsi'];

    // Relasi: Satu kategori memiliki BANYAK buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
