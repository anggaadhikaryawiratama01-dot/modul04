<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute Autentikasi (Guest) ---
// Mengarahkan '/' langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Menambahkan rute GET untuk /login agar tidak "Method Not Allowed"
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Rute Terproteksi (Auth) ---
Route::middleware('auth')->group(function () {

    /**
     * Route Halaman Utama (Dashboard/Home)
     */
    Route::get('/home', function () {
        // Eager loading 'category' untuk optimasi query
        $books = Book::with('category')->latest()->get();

        return view('layouts.home', compact('books'));
    })->name('home');

    /**
     * Route Resource untuk CRUD Buku dan Kategori
     */
    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

});
