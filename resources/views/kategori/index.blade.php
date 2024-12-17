@extends('Admin.layout.main')
@section('content')
{{-- @if ($message = Session::get('success'))
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
	@endif --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">ID</th> 
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategori as $kategori)
                <tr>
                    <td>{{ $kategori->id }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>
                        @if ($kategori->gambar)
                            <img src="{{ asset('kategoris/' . $kategori->gambar) }}" alt="{{ $kategori->nama }}" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

{{-- </div> --}}
@endsection
