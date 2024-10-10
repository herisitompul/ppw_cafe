<!-- resources/views/user/produk/index.blade.php -->

@extends('User.layout.main') <!-- Layout user yang berbeda -->
@section('content')

<!-- Display Produk in a User-Friendly Design -->
<div class="container my-5">
    <h2 class="text-center mb-4">Daftar Produk</h2>
    <div class="row">
        @foreach($produks as $produk)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('gambar/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->judul }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $produk->judul }}</h5>
                    <p class="card-text">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="card-text">{{ Str::limit($produk->deskripsi, 50) }}</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
