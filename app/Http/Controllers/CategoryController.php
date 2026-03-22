<?php

namespace App\Http\Controllers;

use App\Models\Category; // Tambahkan ini agar bisa memanggil database
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        $categories = Category::all();
        // Pastikan kamu punya file resources/views/categories/index.blade.php
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
   public function store(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

    // Ini akan mengambil 'nama_kategori' dari form dan menyimpannya
    Category::create($request->only('nama_kategori'));

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
}

    /**
     * Menampilkan form edit.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Memperbarui data kategori.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus kategori.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
