@extends('pelanggan.layouts.main')

@section('content')
@foreach($items as $item)
    <div>
        <p>{{ $item->layanan->nama }} - {{ $item->jumlah }} x Rp{{ $item->layanan->harga }}</p>
    </div>
@endforeach

<form action="{{ route('order.checkout') }}" method="POST">
    @csrf
    <button type="submit">Pesan Sekarang</button>
</form>


@endsection
