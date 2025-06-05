@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="m-0 flex-grow-1">Data Users</h3>

            <a href="" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('admin.manajemen_user.edit', $user->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.manajemen_user.destroy', $user->id) }}" method="POST"

                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus?')"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
