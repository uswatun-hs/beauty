@extends('pelanggan.layouts.main')

@section('content')
    <h1>Daftar Layanan</h1>
    @foreach($layanans as $layanan)
        <div>
            <img src="{{ asset('storage/' . $layanan->gambar) }}" width="150" alt="{{ $layanan->nama }}">
            <h4>{{ $layanan->nama }}</h4>
            <p>{{ $layanan->deskripsi }}</p>
            <p>Harga: Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
            <a href="{{ route('pelanggan.layanan.show', $layanan->id) }}">Detail</a>
        </div>
    @endforeach
@endsection
