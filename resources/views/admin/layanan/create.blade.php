@extends('admin.layouts.main')

@section('content')
<div class="card">
    <div class="card-header"><h3>Tambah Layanan</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama Layanan</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <div class="mb-3">
                <label>Karyawan</label>
                <select name="karyawan_id" class="form-control" required>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
