@extends('Admin.layout.main')
@section('content')
    <div class="container mt-3 ml-2">
        <h1>Ulasan Produk dari Pengguna</h1>
        
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Nama Pengguna</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $review->produk->judul }}</td>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->review }}</td>
                        <td>{{ $review->created_at->format('d-m-Y') }}</td>
                        <td>
                            <form action="{{ route('review.delete', $review->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-3">
            <h5><strong>Total Ulasan:</strong> {{ $totalReviews }}</h5>
        </div>
    </div>
@endsection
