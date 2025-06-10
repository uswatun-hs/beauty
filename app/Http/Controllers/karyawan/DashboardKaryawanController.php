<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan\Order;
use App\Models\pelanggan\Ulasan;
class DashboardKaryawanController extends Controller
{
    public function index()
    {
        $jumlahorder = Order::count();
        $jumlahulasan = Ulasan::count();

        return view('karyawan.dashboard.dashboard', [
            'jumlahorder' => $jumlahorder,
            'jumlahulasan' => $jumlahulasan,
    ]);
    }
}
