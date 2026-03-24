@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Tambah Koleksi Buku</h3>
            <a href="{{ route('books.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <p class="font-bold">Terjadi Kesalahan:</p>
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-8">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Kategori</label>
                            <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition @error('category_id') border-red-500 @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Judul Buku</label>
                            <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Laravel Mastery"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition @error('judul') border-red-500 @enderror">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Penulis</label>
                            <input type="text" name="penulis" value="{{ old('penulis') }}" placeholder="Nama Penulis"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition @error('penulis') border-red-500 @enderror">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" placeholder="2024"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition @error('tahun_terbit') border-red-500 @enderror">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Stok</label>
                            <input type="number" name="stok" value="{{ old('stok') }}" placeholder="Jumlah"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition @error('stok') border-red-500 @enderror">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Cover Buku</label>
                            <input type="file" name="cover"
                                   class="w-full px-3 py-1.5 border rounded-lg text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                            <p class="text-xs text-gray-400 mt-1 italic">*Format: JPG, PNG, max 2MB</p>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 rounded-xl shadow-lg transition duration-300">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
