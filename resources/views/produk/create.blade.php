@extends('Admin.layout.main')
@section('content')
<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Tambah Produk</h3>
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            {{-- kategori --}}
            <div class="form-group">
                <label for="kategori_id">Kategori:</label>
                <select class="form-control" id="kategori_id" name="kategori_id" required>
                    @foreach($kategori as $kategoriItem)
                        <option value="{{ $kategoriItem->id }}">{{ $kategoriItem->nama }}</option>
                    @endforeach
                </select>
            </div>
            {{-- stok --}}
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="details">Deskripsi</label>
                <textarea class="form-control" id="details" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    @endsection
