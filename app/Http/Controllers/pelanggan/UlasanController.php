<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller; // Tambahkan baris ini
use Illuminate\Http\Request;
use App\Models\pelanggan\Ulasan;
use App\Models\pelanggan\Layanan;

class UlasanController extends Controller
{
    // Menampilkan daftar ulasan
    public function index()
    {
        $data = [
            'ulasan' => Ulasan::with('layanan')->get()
        ];
        return view('pelanggan.ulasan.index', $data);
    }

    // Menampilkan form tambah
    public function create()
    {
        $data = [
            'layanans' => Layanan::all()
        ];
        return view('pelanggan.ulasan.create', $data);
    }

    // Menyimpan ulasan
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'layanan_id' => 'required|exists:layanans,id',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        Ulasan::create($request->all());

        return redirect()->route('pelanggan.ulasan.index')->with('success', 'Rating dan ulasan berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $data = [
            'detail' => Ulasan::findOrFail($id),
            'layanans' => Layanan::all()
        ];
        return view('pelanggan.ulasan.edit', $data);
    }

    // Update ulasan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'layanan_id' => 'required|exists:layanans,id',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $ulasan = Ulasan::findOrFail($id);
        $ulasan->update($request->all());

        return redirect()->route('pelanggan.ulasan.index')->with('success', 'Rating dan ulasan berhasil diperbarui.');
    }

    // Hapus ulasan
    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return back()->with('success', 'Rating dan ulasan berhasil dihapus.');
    }
}
