<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'category_id' => 1, // Pastikan ID kategori ini ada di tabel categories
            'judul' => 'Contoh Buku Laravel',
            'penulis' => 'Admin',
            'tahun_terbit' => 2024,
            'stok' => 10,
        ]);
    }
}
