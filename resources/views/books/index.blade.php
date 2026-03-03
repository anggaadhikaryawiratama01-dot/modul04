@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-3">
    <div class="card-body">
        <h5>Informasi Data</h5>
        <p><strong>Total Buku:</strong> {{ $totalBooks }}</p>
        <ul>
            @foreach($categories as $cat)
                <li>{{ $cat->nama_kategori }}: {{ $cat->books_count }}</li>
            @endforeach
        </ul>
    </div>
</div>

<div class="d-flex justify-content-between mb-3">
    <h3>Data Book</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

<form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul...">
    </div>
    <div class="col-md-4">
        <select name="category_id" class="form-select">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-secondary">Filter</button>
    </div>
</form>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $key => $book)
                    <tr>
                        <td>{{ $books->firstItem() + $key }}</td>
                        <td>{{ $book->judul }}</td>
                        <td>{{ $book->penulis }}</td>
                        <td>{{ $book->tahun_terbit }}</td>
                        <td><span class="badge bg-info">{{ $book->stok }}</span></td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $books->links() }}
    </div>
</div>

@endsection
