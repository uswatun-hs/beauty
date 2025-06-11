@extends('pelanggan.layouts.main')

@section('content')
<div class="checkout-form" style="max-width: 600px; margin: auto;">
    <h2>Informasi Pembayaran</h2>

    <form action="{{ route('pelanggan.order.checkout', $order->id) }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="name">Nama:</label><br>
            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="phone">No HP:</label><br>
            <input type="text" id="phone" name="phone" value="{{ auth()->user()->phone }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Layanan:</label><br>
            <input type="text" value="{{ $order->orderDetails->pluck('layanan.nama')->join(', ') }}" readonly style="width: 100%; padding: 8px; background-color: #f9f9f9;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Total Harga:</label><br>
            <input type="text" value="Rp {{ number_format($order->orderDetails->sum(fn($d) => $d->jumlah * $d->harga), 0, ',', '.') }}" readonly style="width: 100%; padding: 8px; background-color: #f9f9f9;">
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
            Lanjut Bayar
        </button>
    </form>
</div>
@endsection
