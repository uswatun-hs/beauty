<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan\Keranjang;
use App\Models\pelanggan\Order;
use App\Models\pelanggan\Layanan;
class DashboardPelangganController extends Controller
{
    public function index()
    {
        $jumlahkeranjang = Keranjang::count();
        $jumlahorder = Order::count();
        $jumlahlayanan = Layanan::count();

        return view('pelanggan.dashboard.dashboard', [
            'jumlahkeranjang' => $jumlahkeranjang,
            'jumlahorder' => $jumlahorder,
            'jumlahlayanan' => $jumlahlayanan,
        ]);
    }
}
