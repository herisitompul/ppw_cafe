{{-- @extends('layouts.app')

@section('content') --}}
<div class="container">
    <div class="card">
        <div class="card-header">
            Pembayaran Berhasil
        </div>
        <div class="card-body">
            <h5>Terima kasih atas pembayaran Anda!</h5>
            <p>Nomor Pesanan: {{ $order->order_number }}</p>
            <p>Total Pembayaran: Rp {{ number_format($order->total_amount) }}</p>

            <h6>Detail Pesanan:</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->order_details as $item)
                    <tr>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp {{ number_format($item['price']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
