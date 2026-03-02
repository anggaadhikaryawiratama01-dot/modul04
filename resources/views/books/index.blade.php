@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Category</h3>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Jumlah Buku</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $key => $category)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $category->nama_kategori }}</td>
            <td>
                <span class="badge bg-info">
                    {{ $category->books_count }}
                </span>
            </td>
            <td>
                <a href="{{ route('categories.edit',$category->id) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('categories.destroy',$category->id) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">
                Data kosong
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
