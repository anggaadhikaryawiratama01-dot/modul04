@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Tambah Kategori</h3>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text"
                       name="nama_kategori"
                       class="form-control @error('nama_kategori') is-invalid @enderror"
                       id="nama_kategori"
                       value="{{ old('nama_kategori') }}"
                       placeholder="Masukkan nama kategori..."
                       required>

                @error('nama_kategori')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
                <button type="reset" class="btn btn-outline-warning">Reset</button>
            </div>
        </form>
    </div>
</div>
@endsection
