<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan\Layanan;

class LayananController extends Controller
{
    /**
     * Tampilkan semua layanan untuk pelanggan.
     */
    public function index()
    {
        $layanans = Layanan::latest()->paginate(10);
        return view('pelanggan.layanan.index', compact('layanans'));
    }

    /**
     * Tampilkan detail layanan tertentu.
     */
    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('pelanggan.layanan.show', compact('layanan'));
    }
}
