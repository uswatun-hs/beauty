@extends('admin.layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="m-0">Edit User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.manajemen_user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password (kosongkan jika tidak ingin diubah)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                        <option value="karyawan" {{ $user->role === 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                        <option value="pelanggan" {{ $user->role === 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.manajemen_user.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
