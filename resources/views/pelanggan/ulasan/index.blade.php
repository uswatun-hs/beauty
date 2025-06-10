@extends('pelanggan.layouts.main')

@section('content')
<div class="container mt-4">
    <h4 class="text-center fw-bold mb-4">Rating dan Ulasan Anda</h4>
    <a href="{{ route('pelanggan.ulasan.create') }}" class="btn btn-primary mb-3">Tambah Ulasan</a>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Layanan</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ulasan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->layanan->nama ?? '-' }}</td>
                    <td>{{ $item->rating }}</td>
                    <td>{{ $item->ulasan }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('pelanggan.ulasan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pelanggan.ulasan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($ulasan->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Belum ada ulasan.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
