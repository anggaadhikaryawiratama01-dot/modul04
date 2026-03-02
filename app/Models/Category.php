<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //kode memilah kolom yang dapat diisi data nya
    protected $fillable = ['nama_kategori'];

    //kode ini menunjukkan Satu data memiliki BANYAK data buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
