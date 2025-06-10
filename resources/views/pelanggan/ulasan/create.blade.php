@extends('pelanggan.layouts.main')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">Tambah Ulasan</h4>
    <style>
    .star {
        font-size: 7rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
        padding: 0 5px;
        }
         input:checked ~ label,
        input:checked + label,
        .rating-select:hover label:hover,
        .rating-select:hover label:hover ~ label {
            color: gold !important;
        }
    </style>
    <form action="{{ route('pelanggan.ulasan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Anda</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="layanan_id" class="form-label">Layanan</label>
            <select name="layanan_id" class="form-select" required>
                <option value="">-- Pilih Layanan --</option>
                @foreach ($layanans as $layanan)
                    <option value="{{ $layanan->id }}">{{ $layanan->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="rating-select d-flex flex-row-reverse justify-content-center">
                @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="bintang{{ $i }}" name="rating" value="{{ $i }}" hidden>
                    <label for="bintang{{ $i }}" class="star">&#9733;</label>
                @endfor
            </div>
        </div>
        <div class="mb-3">
            <label for="ulasan" class="form-label">Ulasan</label>
            <textarea name="ulasan" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pelanggan.ulasan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
