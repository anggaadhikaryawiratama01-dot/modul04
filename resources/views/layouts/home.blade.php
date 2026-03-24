@extends('layouts.app')

@section('content')

<!-- HERO / BANNER -->
<div style="
    background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb');
    height: 400px;
    background-size: cover;
    background-position: center;
    position: relative;
">

    <div style="
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
    ">
        <h1>Book Collection</h1>
        <p>Explore our best books</p>
    </div>

</div>

<!-- SECTION BAWAH -->
<div class="container mt-5">
    <h3 class="text-center mb-4">Books Collection</h3>

    <div class="row">
        @foreach($books as $book)
        <div class="col-md-3 mb-4">
            <div class="card">

                @if($book->cover)
                    <img src="{{ asset('cover/'.$book->cover) }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;">
                @endif

                <div class="card-body text-center">
                    <h5>{{ $book->judul }}</h5>
                    <p>{{ $book->penulis }}</p>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
