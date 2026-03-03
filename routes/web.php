<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController; // Tambahkan ini

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk Books
Route::resource('books', BookController::class);

// Tambahkan Rute untuk Categories
Route::resource('categories', CategoryController::class);
