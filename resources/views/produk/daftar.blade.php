@extends('Admin.layout.main')
@section('content')
    <div class="container mt-3 ml-3">
        <h1>Daftar Pesanan</h1>
        <table class="table table-bordered mt-2">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Order Number</th>
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width: 30px">Gambar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    @foreach ($order->orderItem as $item)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $item->produk->judul }}</td>
                            <td>{{ $item->produk->kategori->nama }}</td>
                            <td>Rp {{ number_format($item->harga * $item->kuantitas) }}</td>
                            <td>
                                @if ($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($order->status == 'complete')
                                    <h4><span class="badge bg-success w-100">Complete</span></h4>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <img src="{{ asset('gambar/' . $item->produk->gambar) }}" alt="Gambar Produk"
                                    width="50">
                            </td>
                            <td>
                                @if ($order->status == 'pending')
                                    <form action="{{ route('daftar.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger btn-sm" type="submit">Batalkan</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Aksi</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada pesanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
