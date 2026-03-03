@extends('layouts.app')

@section('content')

<h3>Edit Book</h3>

<div class="card">
    <div class="card-body">
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Kategori</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $book->judul) }}">
            </div>

            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $book->penulis) }}">
            </div>

            <div class="mb-3">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $book->tahun_terbit) }}">
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok', $book->stok) }}">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@endsection
