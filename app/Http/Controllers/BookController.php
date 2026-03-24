<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku dengan fitur pencarian, filter, dan statistik data.
     */
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Fitur Pencarian berdasarkan Judul
        if ($request->filled('judul')) {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        }

        // Fitur Filter berdasarkan Kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Mengambil data buku
        $books = $query->get();

        // Menghitung Total Semua Buku untuk statistik di atas tabel
        $totalBooks = Book::count();

        // Mengambil semua kategori untuk dropdown filter
        $categories = Category::all();

        // Menghitung Total Buku per Kategori secara dinamis untuk statistik
        $totalPerCategory = Book::selectRaw('category_id, count(*) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        return view('books.index', compact(
            'books',
            'categories',
            'totalBooks',
            'totalPerCategory'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Menyimpan data buku baru dan file cover ke folder public/cover.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|numeric|exists:categories,id',
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric',
            'stok'         => 'required|numeric',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        // Logika Upload cover ke folder public/cover
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('cover'), $namaFile);
            $data['cover'] = $namaFile;
        }

        Book::create($data);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil ditambahkan!');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Memperbarui data buku dan mengganti cover lama jika ada upload baru.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id'  => 'required|numeric|exists:categories,id',
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric',
            'stok'         => 'required|numeric',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            // Hapus file cover lama jika ada di folder public/cover agar folder tidak penuh
            if ($book->cover && File::exists(public_path('cover/' . $book->cover))) {
                File::delete(public_path('cover/' . $book->cover));
            }

            $file = $request->file('cover');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('cover'), $namaFile);
            $data['cover'] = $namaFile;
        }

        $book->update($data);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diupdate!');
    }

    /**
     * Menghapus data buku beserta file cover fisiknya.
     */
    public function destroy(Book $book)
    {
        // Pastikan file fisik terhapus sebelum record di database dihapus
        if ($book->cover && File::exists(public_path('cover/' . $book->cover))) {
            File::delete(public_path('cover/' . $book->cover));
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil dihapus!');
    }
}
