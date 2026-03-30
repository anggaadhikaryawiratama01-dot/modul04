@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Data Kategori</h2>
        <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition duration-300 shadow-md flex items-center">
            <span class="mr-2">+</span> Tambah
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-blue-600 rounded-lg p-6 shadow-sm border-l-8 border-blue-800">
            <p class="text-blue-100 text-sm font-medium uppercase tracking-wider">Total Kategori</p>
            <h3 class="text-4xl font-bold text-white mt-1">{{ $categories->count() }}</h3>
        </div>
        <div class="bg-green-600 rounded-lg p-6 shadow-sm border-l-8 border-green-800">
            <p class="text-green-100 text-sm font-medium uppercase tracking-wider">Total Semua Buku</p>
            <h3 class="text-4xl font-bold text-white mt-1">{{ \App\Models\Book::count() }}</h3>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-800 text-white uppercase text-sm leading-normal">
                    <th class="py-4 px-6 font-bold w-20 text-center">No</th>
                    <th class="py-4 px-6 font-bold">Nama Kategori</th>
                    <th class="py-4 px-6 font-bold">Deskripsi</th>
                    <th class="py-4 px-6 font-bold text-center">Jumlah Buku</th>
                    <th class="py-4 px-6 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                @forelse($categories as $key => $category)
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200">
                    <td class="py-4 px-6 text-center font-bold">{{ $key + 1 }}</td>
                    <td class="py-4 px-6 font-medium text-gray-900">{{ $category->nama_kategori }}</td>
                    <td class="py-4 px-6 text-gray-500 italic">
                        {{ $category->deskripsi ?? 'Deskripsi kategori tersedia di sini' }}
                    </td>
                    <td class="py-4 px-6 text-center">
                        <span class="bg-blue-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                            {{ $category->books_count }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex item-center justify-center space-x-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-bold py-1.5 px-3 rounded shadow transition duration-300">
                                Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-1.5 px-3 rounded shadow transition duration-300">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-gray-400 italic">Data kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
