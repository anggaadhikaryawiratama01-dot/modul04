@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Category</h3>
    <a href="{{ route('category.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
<div class="card-body">

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th width="200">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->nama_kategori }}</td>
            <td>
                <a href="{{ route('category.show', $category->id) }}" class="btn btn-info btn-sm">Detail</a>

                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('category.destroy', $category->id) }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
</div>

@endsection
