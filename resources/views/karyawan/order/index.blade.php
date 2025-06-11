@extends('karyawan.layouts.main')
@section('content')
    <div class="container my-5">
        <h3>Daftar Pesanan</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Status</th>
                    <th>Detail Pesanan</th>
                    <th>Tanggal Pesan</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            @if ($order->status === 'pending')
                                <form action="{{ route('karyawan.orders.updateStatus', $order->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" class="btn btn-success btn-sm">Terima</button>
                                </form>

                                <form action="{{ route('karyawan.orders.updateStatus', $order->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            @else
                                <span class="badge {{ $order->status === 'diterima' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            @endif
                        </td>
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
                        {{-- <td>
                            @if ($order->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $order->bukti_pembayaran) }}" target="_blank"
                                    class="btn btn-sm btn-info">
                                    Lihat Bukti
                                </a>
                            @else
                                <span class="text-muted">Belum diupload</span>
                            @endif
                        </td> --}}
                        <td>
                            @if ($order->payment_status === 'settlement')
                                <span class="badge bg-success">Lunas</span>
                            @elseif ($order->payment_status === 'pending')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif ($order->payment_status === 'expire')
                                <span class="badge bg-danger">Kadaluarsa</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->payment_status) }}</span>
                            @endif
                        </td>


                        <td>
                            @if ($order->status === 'menunggu_konfirmasi' && $order->bukti_pembayaran)
                                <form action="{{ route('karyawan.order.konfirmasiPembayaran', $order->id) }}"
                                    method="POST">
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
