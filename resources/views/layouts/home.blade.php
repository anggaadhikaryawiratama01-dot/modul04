@extends('layouts.app')

@section('content')

{{-- Hero Section --}}
<div class="relative w-full h-[450px] overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent flex items-center">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight">
                Exclusive <br> <span class="text-blue-400">Book Collection</span>
            </h1>
            <p class="mt-4 text-gray-200 text-lg max-w-md">
                Discover a world of knowledge and inspiration through our curated selection of premium books.
            </p>
            <div class="mt-8">
                <a href="#collection" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition duration-300 shadow-lg">
                    Browse Now
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Collection Section --}}
<div id="collection" class="container mx-auto px-6 py-16">
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Our Collections</h2>
            <div class="h-1 w-20 bg-blue-500 mt-2"></div>
        </div>
        <p class="text-gray-500 font-medium">Showing {{ $books->count() }} Books</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($books as $book)
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
            <div class="relative overflow-hidden h-[300px]">
                {{-- Cek Cover --}}
                @if($book->cover && file_exists(public_path('cover/'.$book->cover)))
                    <img src="{{ asset('cover/'.$book->cover) }}"
                         alt="{{ $book->judul }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 italic">No Cover</span>
                    </div>
                @endif

                {{-- Badge Kategori --}}
                @if($book->category)
                <div class="absolute top-4 left-4">
                    <span class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                        {{ $book->category->name }}
                    </span>
                </div>
                @endif
            </div>

            <div class="p-6 text-center">
                <h5 class="text-lg font-bold text-gray-800 truncate">{{ $book->judul }}</h5>
                <p class="text-blue-500 text-sm font-medium mt-1">{{ $book->penulis }}</p>
                <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between items-center text-xs text-gray-400">
                    <span>Year: {{ $book->tahun_terbit }}</span>
                    <span>Stock: {{ $book->stok }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <p class="text-gray-400 text-xl italic">No books available in the collection yet.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
