@extends('admin.layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Karyawan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $karyawan->nama) }}" class="form-control"
                        required>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $karyawan->email) }}" class="form-control"
                        required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $karyawan->telepon) }}"
                        class="form-control">
                    @error('telepon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki"
                            {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="Perempuan"
                            {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                    @error('jenis_kelamin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat', $karyawan->alamat) }}</textarea>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Foto</label>
                    @if ($karyawan->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="Foto" width="100">
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control">
                    @error('foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
                <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
