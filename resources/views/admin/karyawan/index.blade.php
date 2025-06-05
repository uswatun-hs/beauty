@extends('admin.layouts.main')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Data Karyawan</h3>
        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah
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
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $karyawan->nama }}</td>
                    <td>{{ $karyawan->email }}</td>
                    <td>{{ $karyawan->telepon }}</td>
                    <td>{{ $karyawan->jenis_kelamin }}</td>
                    <td>{{ $karyawan->alamat }}</td>
                    <td>
                        @if ($karyawan->foto)
                            <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="Foto" width="50">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
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
