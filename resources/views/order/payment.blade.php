@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h3>Silakan Lakukan Pembayaran</h3>
    <p>Scan QRIS berikut untuk menyelesaikan pembayaran:</p>
    <img src="{{ asset('images/qris-sample.png') }}" alt="QRIS" style="width: 300px;">

    <form action="{{ route('order.success') }}" method="GET">
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <button type="submit" class="btn btn-success mt-3">Konfirmasi Pembayaran</button>
    </form>
</div>
@endsection
