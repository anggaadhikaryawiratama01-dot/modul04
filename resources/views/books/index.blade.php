@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Book</h2>
        <a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
            + Tambah Book
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-5 rounded-xl shadow-sm mb-6 border border-gray-200">
        <p class="font-bold text-gray-700 mb-2">Total Data Book: <span class="text-blue-600">{{ $totalBooks }}</span></p>
        <p class="font-bold text-sm text-gray-600 mb-2">Total Book per Category:</p>
        <ul class="list-disc ml-6 text-sm text-gray-700 space-y-1">
            @foreach($categories as $category)
                <li><span class="font-medium">{{ $category->name }}</span> : {{ $category->books_count }}</li>
            @endforeach
        </ul>
    </div>

    <form action="{{ route('books.index') }}" method="GET" class="flex flex-wrap gap-3 mb-6 items-center">
        <input type="text" name="search" placeholder="Cari Judul..."
               class="border border-gray-300 rounded-lg px-4 py-2 w-full max-w-xs focus:ring-2 focus:ring-blue-500 outline-none"
               value="{{ request('search') }}">

        <select name="category" class="border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg font-medium transition">
                Filter
            </button>
            <a href="{{ route('books.index') }}" class="bg-gray-900 hover:bg-black text-white px-6 py-2 rounded-lg font-medium transition text-center">
                Reset
            </a>
        </div>
    </form>

    <div class="overflow-hidden rounded-xl shadow-md border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-black text-white italic">
                    <th class="p-4 border-b border-gray-700 font-semibold uppercase text-sm">No</th>
                    <th class="p-4 border-b border-gray-700 font-semibold uppercase text-sm">Cover</th>
                    <th class="p-4 border-b border-gray-700 font-semibold uppercase text-sm">Judul</th>
                    <th class="p-4 border-b border-gray-700 font-semibold uppercase text-sm">Penulis</th>
                    <th class="p-4 border-b border-gray-700 font-semibold uppercase text-sm text-center">Tahun</th>
                    <th class="p-4 border-b border-gray-700 font-semibold uppercase text-sm text-center">Stok</th>
                    <th class="p-4 border-b border-gray-700 font-semibold uppercase text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($books as $index => $book)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="p-4 text-gray-700">{{ $index + $books->firstItem() }}</td>
                    <td class="p-4">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="w-16 h-20 object-cover rounded shadow-sm border border-gray-100">
                        @else
                            <div class="w-16 h-20 bg-gray-100 rounded flex items-center justify-center text-[10px] text-gray-400 border border-dashed border-gray-300">
                                No Cover
                            </div>
                        @endif
                    </td>
                    <td class="p-4 font-semibold text-gray-900">{{ $book->title }}</td>
                    <td class="p-4 text-gray-600">{{ $book->author }}</td>
                    <td class="p-4 text-center text-gray-600">{{ $book->year }}</td>
                    <td class="p-4 text-center">
                        <span class="bg-blue-500 text-white px-2.5 py-1 rounded-full text-xs font-bold shadow-sm">
                            {{ $book->stock }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('books.edit', $book->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-1.5 rounded-md text-sm font-medium transition">
                                Edit
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-md text-sm font-medium transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-12 text-center text-gray-400 italic bg-gray-50">
                        Belum ada data buku yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $books->appends(request()->query())->links() }}
    </div>
</div>
@endsection
