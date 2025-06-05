@extends('admin.layouts.main')

@section('content')
<div class="card">
    <div class="card-header"><h3>Edit Layanan</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Layanan</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $layanan->nama) }}" required>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga', $layanan->harga) }}" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                @if ($layanan->gambar)
                    <img src="{{ asset('storage/' . $layanan->gambar) }}" width="100" class="mb-2"><br>
                @else
                    <p>Tidak ada gambar</p>
                @endif
                <label>Ganti Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <div class="mb-3">
                <label>Pilih Karyawan</label>
                <select name="karyawan_id" class="form-control" required>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" {{ $layanan->karyawan_id == $karyawan->id ? 'selected' : '' }}>
                            {{ $karyawan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
