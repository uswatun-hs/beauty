@extends('pelanggan.layouts.main')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="{{ $layanan->nama }}"
                    class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">{{ $layanan->nama }}</h2>

                <p class="fs-5">
                    <strong>Harga:</strong> Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                </p>

                <p class="text-muted">
                    <strong>Deskripsi:</strong><br>
                    {{ $layanan->deskripsi }}
                </p>

                <form action="{{ route('pelanggan.keranjang.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                    </button>
                    <a href="{{ route('pelanggan.layanan.index') }}" class="btn btn-outline-secondary ms-2">
                        ← Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
