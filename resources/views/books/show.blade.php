@extends('layouts.app')

@section('content')

<h3>Detail Book</h3>

<div class="card">
    <div class="card-body">
        <p><strong>Judul:</strong> {{ $book->judul }}</p>
        <p><strong>Kategori:</strong> {{ $book->category->nama_kategori }}</p>
        <p><strong>Penulis:</strong> {{ $book->penulis }}</p>
        <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit }}</p>
        <p><strong>Stok:</strong> {{ $book->stok }}</p>

        <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection
