@extends('pelanggan.layouts.main')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Daftar Layanan</h1>

        <div class="row">
            @foreach($layanans as $layanan)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $layanan->gambar) }}" class="card-img-top" alt="{{ $layanan->nama }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $layanan->nama }}</h5>
                            <p class="card-text small text-muted">{{ Str::limit($layanan->deskripsi, 100) }}</p>
                            <p class="fw-bold mb-2">Harga: Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('pelanggan.layanan.show', $layanan->id) }}" class="btn btn-primary mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
