@extends('layouts.app')

@section('content')

<h3>Edit Category</h3>

<div class="card">
<div class="card-body">

<form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text"
               name="nama_kategori"
               class="form-control"
               value="{{ $category->nama_kategori }}">
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('category.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

@endsection
