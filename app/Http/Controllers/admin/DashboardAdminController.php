<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Karyawan;
use App\Models\User;
use App\Models\admin\Layanan;
class DashboardAdminController extends Controller
{
     public function index()
    {
        $jumlahkaryawan = Karyawan::count();
        $jumlahuser = User::count();
        $jumlahlayanan = Layanan::count();

        return view('admin.dashboard.dashboard', [
            'jumlahkaryawan' => $jumlahkaryawan,
            'jumlahuser' => $jumlahuser,
            'jumlahlayanan' => $jumlahlayanan,
    ]);
    }
}
