@extends('pelanggan.layouts.main')

@section('content')
    <div class="container">
        <h3>Riwayat Pesanan</h3>

        {{-- Pesan Sukses/Error --}}
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        @if ($orders->isEmpty())
            <p>Belum ada pesanan.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Layanan</th>
                        <th>Gambar</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Bukti Pembayaran</th>
                        <th>Waktu Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @php
                            $totalHarga = $order->orderDetails->sum(function ($detail) {
                                return $detail->jumlah * $detail->harga;
                            });
                            $layananList = $order->orderDetails
                                ->map(function ($d) {
                                    return $d->layanan->nama . ' x ' . $d->jumlah;
                                })
                                ->implode(', ');
                        @endphp
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $layananList }}</td>
                            <td>
                                @foreach ($order->orderDetails as $detail)
                                    <img src="{{ asset('storage/' . $detail->layanan->gambar) }}"
                                        alt="{{ $detail->layanan->nama }}" width="60" class="img-thumbnail me-1 mb-1">
                                @endforeach
                            </td>

                            <td>{{ $order->orderDetails->sum('jumlah') }}</td>

                            <td>Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->status)) }}</td>
                            <td>
                                @if ($order->status === 'pending')
                                    <form method="POST" action="{{ route('pelanggan.order.destroy', $order->id) }}"
                                        onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                    </form>
                                @elseif ($order->status === 'menunggu_pembayaran')
                                    <a href="{{ route('pelanggan.order.paymentForm', $order->id) }}"
                                        class="btn btn-primary btn-sm">Bayar</a>
                                @else
                                    <span class="text-muted">Tidak bisa dibatalkan</span>
                                @endif
                            </td>

                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>
                                @if ($order->status === 'pending')
                                    <form method="POST" action="{{ route('pelanggan.order.destroy', $order->id) }}"
                                        onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
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
