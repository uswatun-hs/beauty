@extends('admin.layouts.main')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Data Layanan</h3>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Layanan
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Karyawan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layanans as $layanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $layanan->nama }}</td>
                    <td>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</td>
                    <td>{{ $layanan->deskripsi }}</td>
                    <td>
                        @if ($layanan->gambar)
                            <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="Gambar" width="60">
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                    <td>{{ $layanan->karyawan->nama ?? 'Tidak Ada' }}</td>
                    <td>
                        <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
