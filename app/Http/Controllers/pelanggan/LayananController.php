<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use App\Models\admin\Layanan; // pakai model layanan admin supaya data sama
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        // Ambil semua layanan termasuk relasi karyawan jika perlu
        $layanans = Layanan::with('karyawan')->get();

        // Kirim data ke view pelanggan.layanan.index
        return view('pelanggan.layanan.index', compact('layanans'));
    }

    public function show(Layanan $layanan)
    {
        // Detail layanan yang dipilih
        return view('pelanggan.layanan.show', compact('layanan'));
    }

    // Kalau tidak perlu fitur create, store, edit, update, destroy untuk pelanggan,
    // jangan buat atau bisa di disable supaya pelanggan tidak bisa tambah/ubah layanan.
}
