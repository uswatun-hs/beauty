@extends('admin.layouts.main')
@section('content')
<div class="cand">
    <div class="card-header">
        <h4 class="judul-jadwal">Rating Dan Ulasan</h4>
        <style>
            .judul-jadwal {
                text-align: center;
                font-weight: bold;
                margin-bottom: 20px;
            }
        </style>
    </div>
    <div class="card-body">
        <div class="container-fluid mt-6">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Ulasan</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ulasan as $index => $item)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->layanan->nama ?? '-' }}</td>
                        <td>{{ $item->rating }}</td>
                        <td>{{ $item->ulasan }}</td>
                        <td>{{ $item->tanggal }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
