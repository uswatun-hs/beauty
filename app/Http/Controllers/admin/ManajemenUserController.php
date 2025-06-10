<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.manajemen_user.index', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('admin.manajemen_user.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('manajemen_user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan form edit user
    public function edit(User $manajemen_user)
    {
        return view('admin.manajemen_user.edit', ['user' => $manajemen_user]);
    }

    // Update user
    public function update(Request $request, User $manajemen_user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $manajemen_user->id,
            'role' => 'required|in:admin,owner,karyawan,pelanggan',
            'password' => 'nullable|string|min:6', // opsional, min 6 karakter jika diisi
        ]);

        $data = $request->only('name', 'email', 'role');

        if ($request->filled('password')) {
            $data['password'] = \Hash::make($request->password);
        }

        $manajemen_user->update($data);

        return redirect()->route('admin.manajemen_user.index')->with('success', 'User berhasil diperbarui.');
    }


    // Hapus user
    public function destroy(User $manajemen_user)
    {
        $manajemen_user->delete();
        return redirect()->route('admin.manajemen_user.index')->with('success', 'User berhasil dihapus.');
    }
}
