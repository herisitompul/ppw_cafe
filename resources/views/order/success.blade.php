@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h3>Pesanan Anda Berhasil!</h3>
    <p>Pesanan Anda sedang diproses.</p>
    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection
