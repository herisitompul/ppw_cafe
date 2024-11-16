@extends('Admin.layout.main')
@section('content')

<form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h3>Tambah Kategori</h3>
    <div class="form-group">
        <label for="title">Nama Kategori</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
