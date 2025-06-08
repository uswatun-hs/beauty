@extends('pelanggan.layouts.main')

@section('content')
    <div class="container my-5">
        <h3 class="mb-4">Keranjang Anda</h3>

        @if ($keranjangs->isEmpty())
            <div class="alert alert-info">Keranjang kosong.</div>
        @else
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th>Layanan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keranjangs as $item)
                        <tr>
                            <td>
                                <form method="POST" id="selectForm{{ $item->layanan_id }}">
                                    {{-- Checkbox masuk form order --}}
                                    <input type="checkbox" name="layanan_ids[]" form="orderForm"
                                        value="{{ $item->layanan_id }}">
                                </form>
                            </td>
                            <td>{{ $item->layanan->nama }}</td>
                            <td>Rp {{ number_format($item->layanan->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex">
                                    {{-- Tombol - --}}
                                    <form method="POST"
                                        action="{{ route('pelanggan.keranjang.update', $item->layanan_id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="action" value="decrease">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                                    </form>

                                    <input type="text" value="{{ $item->jumlah }}"
                                        class="form-control form-control-sm text-center mx-1" readonly style="width: 50px;">

                                    {{-- Tombol + --}}
                                    <form method="POST"
                                        action="{{ route('pelanggan.keranjang.update', $item->layanan_id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="action" value="increase">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('pelanggan.keranjang.destroy', $item->layanan_id) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Form Order Sekarang, terpisah --}}
            <form method="POST" action="{{ route('pelanggan.order.store') }}" id="orderForm">
                @csrf
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="bi bi-bag-check"></i> Order Sekarang
                </button>
            </form>

            @if (session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('input[name="layanan_ids[]"]');
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            }
        });
    </script>
@endsection
