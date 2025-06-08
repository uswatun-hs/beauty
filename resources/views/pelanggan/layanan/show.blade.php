@extends('pelanggan.layouts.main')

@section('content')
    <h1>{{ $layanan->nama }}</h1>

    <img src="{{ asset('storage/' . $layanan->gambar) }}" width="300" alt="{{ $layanan->nama }}">

    <p><strong>Harga:</strong> Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
    <p><strong>Deskripsi:</strong> {{ $layanan->deskripsi }}</p>

    <a href="{{ route('pelanggan.layanan.index') }}">← Kembali ke daftar layanan</a>
    <form action="{{ route('pelanggan.keranjang.store') }}" method="POST">
    @csrf
    <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">
    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
</form>



@endsection
