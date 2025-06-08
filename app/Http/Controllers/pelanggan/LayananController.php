<?php

// File: app/Http/Controllers/pelanggan/LayananController.php
namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use App\Models\admin\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all(); // atau bisa pakai paginate()
        return view('pelanggan.layanan.index', compact('layanans'));
    }

    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('pelanggan.layanan.show', compact('layanan'));
    }
}
