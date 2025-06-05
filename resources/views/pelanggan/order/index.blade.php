@extends('pelanggan.layouts.main')

@section('content')
<form action="{{ route('order.checkout') }}" method="POST">
    @csrf
    <div>
        <label>Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" required>
    </div>

    <div>
        <label>No. Telepon</label>
        <input type="text" name="no_telepon" required>
    </div>

    <div>
        <label>Tempat Layanan</label>
        <select name="tempat_layanan" id="tempat_layanan" required onchange="toggleAlamat()">
            <option value="salon">Salon</option>
            <option value="rumah">Rumah</option>
        </select>
    </div>

    <div id="alamatDiv" style="display: none;">
        <label>Alamat (jika di rumah)</label>
        <textarea name="alamat"></textarea>
    </div>

    <button type="submit">Pesan Sekarang</button>
</form>

<script>
    function toggleAlamat() {
        const tempat = document.getElementById('tempat_layanan').value;
        document.getElementById('alamatDiv').style.display = tempat === 'rumah' ? 'block' : 'none';
    }
</script>


@endsection
