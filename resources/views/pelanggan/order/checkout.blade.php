@extends('pelanggan.layouts.main')

@section('content')

<style>
    .checkout-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f3f4f6;
    }

    .checkout-box {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 100%;
        max-width: 400px;
    }

    .checkout-box h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
    }

    .checkout-box p {
        color: #666;
        margin-bottom: 20px;
    }

    #pay-button {
        background-color: #4F46E5;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #pay-button:hover {
        background-color: #4338CA;
    }
</style>

<div class="checkout-container">
    <div class="checkout-box">
        <h2>Pembayaran Pesanan</h2>
        <p>Klik tombol di bawah untuk melanjutkan pembayaran.</p>
        <button id="pay-button">Bayar Sekarang</button>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                alert("Pembayaran berhasil!");
                window.location.href = '/pelanggan/orders';
            },
            onPending: function (result) {
                alert("Menunggu pembayaran.");
            },
            onError: function (result) {
                alert("Terjadi kesalahan.");
            },
            onClose: function () {
                alert('Kamu menutup popup tanpa menyelesaikan pembayaran.');
            }
        });
    };
</script>


@endsection
