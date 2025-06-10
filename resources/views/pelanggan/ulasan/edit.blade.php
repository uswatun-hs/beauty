@extends('pelanggan.layouts.main')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">Edit Ulasan</h4>
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
            <label class="form-label">Rating</label>
            <div class="rating-select d-flex flex-row-reverse justify-content-center">
                @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="bintang{{ $i }}" name="rating" value="{{ $i }}" hidden
                        @if(old('rating', $detail->rating) == $i) checked @endif>
                    <label for="bintang{{ $i }}" class="star">&#9733;</label>
                @endfor
            </div>
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
