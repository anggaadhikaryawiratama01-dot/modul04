<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/**
 * Route Halaman Utama (Landing Page)
 * Mengambil data buku beserta kategorinya untuk ditampilkan di home.blade.php
 */
Route::get('/', function () {
    // Eager loading 'category' agar tidak error saat memanggil $book->category->name
    $books = Book::with('category')->latest()->get();

    // Mengarahkan ke file resources/views/layouts/home.blade.php
    return view('layouts.home', compact('books'));
});

/**
 * Route Resource untuk CRUD Buku dan Kategori
 * Menggunakan BookController dan CategoryController
 */
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
