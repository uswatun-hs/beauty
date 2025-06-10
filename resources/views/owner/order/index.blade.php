@extends('owner.layouts.main')

@section('content')
    <div class="container my-5">
        <h3>Daftar Pesanan</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Detail Pesanan</th>
                    <th>Tanggal Pesan</th>
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            <ul class="mb-0">
                                @foreach ($order->orderDetails as $detail)
                                    <li>
                                        {{ $detail->layanan->nama }} x {{ $detail->jumlah }} =
                                        Rp {{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td>
                            @if ($order->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $order->bukti_pembayaran) }}" target="_blank"
                                    class="btn btn-sm btn-info">
                                    Lihat Bukti
                                </a>
                            @else
                                <span class="text-muted">Belum diupload</span>
                            @endif
                        </td>

                        <td>
                            @if ($order->status === 'menunggu_konfirmasi' && $order->bukti_pembayaran)
                                <form action="{{ route('admin.order.konfirmasiPembayaran', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Konfirmasi Pembayaran</button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada pesanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $orders->links() }}
    </div>
@endsection
