@extends('Admin.layout.main')
@section('content')
@if ($message = Session::get('success'))
	  <div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		  <strong>{{ $message }}</strong>
	  </div>
	@endif

	@if ($message = Session::get('error'))
	  <div class="alert alert-danger alert-block">
	    <button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	  </div>
	@endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="width: 10px">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Kategori</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga</th>
                <th scope="col"style="width: 500px">Deskripsi</th>
                <th scope="col" style="width: 30px">Gambar</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $index => $produk )
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $produk->judul }}</td>
                <td>{{ $produk->kategori->nama }}</td>
                <td>{{ $produk->stok }}</td>
                {{-- <td>{{ $produk->jenis }}</td> --}}
                <td>{{ $produk->harga }}</td>
                <td>{{ $produk->deskripsi }}</td>
                <td><img src="{{ asset('gambar/' . $produk->gambar) }}" alt="" style="width: 150px"></td>
                <td>
                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>

                @endforeach
        </tbody>
    </table>
@endsection
