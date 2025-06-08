@extends('pelanggan.layouts.main')

@section('content')
<div class="container">
    <h3>Riwayat Pesanan</h3>

    @if($orders->isEmpty())
        <p>Belum ada pesanan.</p>
    @else
        {{-- Pesan Sukses/Error --}}
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Layanan</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Waktu Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->layanan->nama ?? '-' }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>
                            @if($order->layanan)
                                Rp {{ number_format($order->jumlah * $order->layanan->harga, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($order->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($order->status === 'proses')
                                <span class="badge bg-info text-white">Diproses</span>
                            @elseif ($order->status === 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td>
                            @if($order->status === 'pending')
                                <form method="POST" action="{{ route('pelanggan.order.destroy', $order->id) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                </form>
                            @else
                                <span class="text-muted">Tidak bisa dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
