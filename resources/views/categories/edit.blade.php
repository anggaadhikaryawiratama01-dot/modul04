@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="mb-3">Edit Category</h3>

    {{-- Pesan Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text"
                           name="nama_kategori"
                           value="{{ old('nama_kategori', $category->nama_kategori) }}"
                           class="form-control"
                           placeholder="Masukkan nama kategori..."
                           required>
                </div>

                <hr>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Update Category</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
