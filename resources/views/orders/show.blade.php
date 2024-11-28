@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pesanan</h1>
    <p>Nomor Pesanan: {{ $order->id }}</p>
    <p>Status: {{ $order->status }}</p>
    <p>Total Harga: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

    <h3>Produk yang Dipesan</h3>
    <ul>
        <li>{{ $order->produk->judul }} x {{ $order->quantity }}</li>
    </ul>
</div>
@endsection
