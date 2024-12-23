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
                @php
                    $totalPenjualan = 0; // Inisialisasi total
                @endphp
                @forelse ($orders as $order)
                    @foreach ($order->orderItem as $item)
                        @php
                            // Tambahkan harga item ke total penjualan
                            $totalPenjualan += $item->harga * $item->kuantitas;
                        @endphp
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
                                <img src="{{ asset('gambar/' . $item->produk->gambar) }}" alt="Gambar Produk" width="50">
                            </td>
                            <td>
                                @if ($order->status == 'pending')
                                    <form action="{{ route('daftar.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger btn-sm" type="submit">Batalkan</button>
                                    </form>
                                @else
                                    <form action="{{ route('order.delete', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
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
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total Penjualan:</strong></td>
                    <td colspan="4"><strong>Rp {{ number_format($totalPenjualan) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <!-- Tambahkan pagination -->
        <div class="d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
