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

Route::get('/', function () {
    $books = Book::latest()->get(); // ambil data buku
    return view('home', compact('books')); // kirim ke home.blade.php
});

Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
