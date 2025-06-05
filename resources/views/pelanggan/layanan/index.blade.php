@extends('pelanggan.layouts.main')
@section('content')

@foreach($layanans as $layanan)
    <div>
        <img src="{{ asset('storage/' . $layanan->gambar) }}" width="100">
        <h4>{{ $layanan->nama }}</h4>
        <p>{{ $layanan->deskripsi }}</p>
        <p>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
        <form action="{{ route('cart.tambah', $layanan->id) }}" method="POST">
            @csrf
            <button type="submit">Tambah ke Keranjang</button>
        </form>
    </div>
@endforeach
@endsection

