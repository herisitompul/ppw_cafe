@extends('Admin.layout.main')
@section('content')
<form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ $produk->judul }}" required>
    </div>
    <div class="form-group">
        <label for="kategori_id">Kategori:</label>
        <select class="form-control" id="kategori_id" name="kategori_id" required>
            @foreach($kategori as $kategoriItem)
                <option value="{{ $kategoriItem->id }}">{{ $kategoriItem->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" id="stok" name="stok" value="{{ $produk->stok }}" required>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="{{ $produk->harga }}" required>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $produk->deskripsi }}</textarea>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar:</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
        <img src="{{ asset('gambar/' . $produk->gambar) }}" alt="{{ $produk->gambar }}" width="100">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
