<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk mengelola file

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query()->with('category');

        if ($request->filled('search')) {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->paginate(10)->withQueryString();

        $totalBooks = Book::count();
        $categories = Category::withCount('books')->get();

        return view('books.index', compact('books', 'categories', 'totalBooks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|numeric',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi cover
        ]);

        $data = $request->only(['category_id', 'judul', 'penulis', 'tahun_terbit', 'stok']);

        // Logika Upload Cover
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required|numeric|exists:categories,id',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi cover
        ]);

        $data = $request->only(['category_id', 'judul', 'penulis', 'tahun_terbit', 'stok']);

        // Logika Update Cover
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            // Simpan cover baru
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        // Hapus file cover dari storage saat data dihapus
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Data berhasil dihapus');
    }
}
