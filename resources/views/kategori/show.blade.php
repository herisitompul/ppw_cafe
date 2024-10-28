@extends('Admin.layout.main')
@section('content')
<p><strong>ID:</strong> {{ $kategori->id }}</p>
    <p><strong>Name:</strong> {{ $kategori->nama }}</p>
    <h3>Produk in this kategori</h3>
    @if($produk->isEmpty())

        <p>No produk found for this kategori.</p>
    @else
        <ul>
            @foreach($produk as $produk)
                <li>
                    <a href="{{ route('produk.show', $produk->id) }}"><h3>{{ $produk->judul }}</h3></a>
                    <p>{{ $produk->deskripsi }}</p>
                    <p>Kategori: {{ $produk->kategori->nama }}</p>
                    <img src="{{ asset('gambar/' . $produk->gambar) }}" alt="{{ $produk->judul }}" width="200"> <br> <br>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Back</a>
@endsection
