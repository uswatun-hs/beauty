@extends('pelanggan.layouts.main')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">Edit Ulasan</h4>

    <form action="{{ route('pelanggan.ulasan.update', $detail->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Anda</label>
            <input type="text" name="nama" class="form-control" value="{{ $detail->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="layanan_id" class="form-label">Layanan</label>
            <select name="layanan_id" class="form-select" required>
                @foreach ($layanans as $layanan)
                    <option value="{{ $layanan->id }}" {{ $detail->layanan_id == $layanan->id ? 'selected' : '' }}>
                        {{ $layanan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1–5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ $detail->rating }}" required>
        </div>

        <div class="mb-3">
            <label for="ulasan" class="form-label">Ulasan</label>
            <textarea name="ulasan" class="form-control" rows="4" required>{{ $detail->ulasan }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $detail->tanggal }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('pelanggan.ulasan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
