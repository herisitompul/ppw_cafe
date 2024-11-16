@extends('Admin.layout.main')
@section('content')
<form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $kategori->nama }}" required>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
        @if ($kategori->gambar)
            <img src="{{ asset('kategoris/' . $kategori->gambar) }}" alt="{{ $kategori->nama }}" width="100">
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
