<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            [
                'nama_kategori' => 'Teknologi',

            ],
            [
                'nama_kategori' => 'Sains',

            ],
            [
                'nama_kategori' => 'Sastra',
               
            ],
        ]);
    }
}
