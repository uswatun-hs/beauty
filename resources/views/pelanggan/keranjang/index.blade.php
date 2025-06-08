@extends('pelanggan.layouts.main')

@section('content')
    <div class="container">
        <h3>Keranjang Anda</h3>

        @if ($keranjangs->isEmpty())
            <p>Keranjang kosong.</p>
        @else
            <form method="POST" action="{{ route('pelanggan.order.store') }}">
                @csrf

                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" /></th>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjangs as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="layanan_ids[]"
                                        value="{{ $item['layanan_id'] ?? $item->id }}" />
                                </td>
                                <td>{{ $item['nama'] ?? $item->layanan->nama }}</td>
                                <td>{{ $item['harga'] ?? $item->layanan->harga }}</td>
                                <td>
                                    <div class="input-group" style="max-width: 120px;">
                                        <form method="POST"
                                            action="{{ route('pelanggan.keranjang.update', $item['layanan_id'] ?? $item->id) }}"
                                            style="display: flex;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="action" value="decrease"
                                                class="btn btn-sm btn-secondary">-</button>
                                            <input type="text" name="jumlah" value="{{ $item['jumlah'] }}"
                                                class="form-control text-center" readonly>
                                            <button type="submit" name="action" value="increase"
                                                class="btn btn-sm btn-secondary">+</button>
                                        </form>
                                    </div>
                                </td>

                                <td>
                                    <form method="POST"
                                        action="{{ route('pelanggan.keranjang.destroy', $item['layanan_id'] ?? $item->id) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary mt-2">Order</button>

                @if (session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                @endif
            </form>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('input[name="layanan_ids[]"]');
                    checkboxes.forEach(cb => cb.checked = checkAll.checked);
                });
            }
        });
    </script>
@endsection
