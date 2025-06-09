@extends('pelanggan.layouts.main')

@section('content')
<div class="container my-5">
    <h3>Bayar Pesanan #{{ $order->id }}</h3>

    <form action="{{ route('pelanggan.order.processPayment', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required>
            @error('bukti_pembayaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
    </form>
</div>
@endsection
