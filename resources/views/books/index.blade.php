@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Book</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row mb-3">
    {{-- TOTAL DATA --}}
    <div class="col-md-4">
        <div class="alert alert-info h-100 mb-0">
            Total Data Book: <strong>{{ $totalBooks }}</strong>
        </div>
    </div>

    {{-- TOTAL PER CATEGORY --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-body py-2">
                <h6 class="card-title mb-1">Total Book per Category:</h6>
                <div class="d-flex flex-wrap gap-3">
                    @foreach($categories as $category)
                        <span class="badge bg-light text-dark border">
                            {{ $category->nama_kategori }}:
                            <strong>{{ $totalPerCategory[$category->id] ?? 0 }}</strong>
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FORM SEARCH & FILTER --}}
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('books.index') }}" class="row g-2">
            <div class="col-md-5">
                <input type="text" name="judul" class="form-control"
                       placeholder="Cari Judul..."
                       value="{{ request('judul') }}">
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" width="50">No</th>
                    <th class="text-center" width="100">Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center" width="160">Aksi</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @forelse($books as $key => $book)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">
                        @if($book->cover)
                            <img src="{{ asset('cover/'.$book->cover) }}"
                                 width="60"
                                 class="rounded shadow-sm"
                                 style="height:80px; object-fit:cover;">
                        @else
                            <div class="text-muted small">No Cover</div>
                        @endif
                    </td>
                    <td><strong>{{ $book->judul }}</strong></td>
                    <td>{{ $book->penulis }}</td>
                    <td class="text-center">{{ $book->tahun_terbit }}</td>
                    <td class="text-center">
                        <span class="badge bg-info">{{ $book->stok }}</span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('books.edit', $book->id) }}"
                               class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('books.destroy', $book->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus data?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        Data tidak ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Book</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- TOTAL DATA --}}
<div class="alert alert-info">
    Total Data Book: <strong>{{ $totalBooks }}</strong>
</div>

{{-- TOTAL PER CATEGORY --}}
<div class="card mb-3">
    <div class="card-body">
        <h5>Total Book per Category</h5>
        <ul>
            @foreach($categories as $category)
                <li>
                    {{ $category->nama_kategori }} :
                    <strong>
                        {{ $totalPerCategory[$category->id] ?? 0 }}
                    </strong>
                </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- FORM SEARCH & FILTER --}}
<form method="GET" action="{{ route('books.index') }}" class="row mb-3">

    <div class="col-md-4">
        <input type="text" name="judul" class="form-control"
               placeholder="Cari Judul..."
               value="{{ request('judul') }}">
    </div>

    <div class="col-md-4">
        <select name="category_id" class="form-select">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <button class="btn btn-primary">Filter</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Reset</a>
    </div>

</form>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Cover</th> <!-- ✅ TAMBAHAN -->
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $key => $book)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <!-- ✅ TAMPIL COVER -->
                    <td>
                        @if($book->cover)
                            <img src="{{ asset('cover/'.$book->cover) }}"
                                 width="60"
                                 style="height:80px; object-fit:cover;">
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $book->judul }}</td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->tahun_terbit }}</td>
                    <td>
                        <span class="badge bg-info">{{ $book->stok }}</span>
                    </td>
                    <td>
                        <a href="{{ route('books.edit',$book->id) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('books.destroy',$book->id) }}"
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
                    <td colspan="7" class="text-center">
                        Data tidak ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
