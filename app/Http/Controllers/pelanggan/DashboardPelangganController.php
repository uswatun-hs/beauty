<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPelangganController extends Controller
{
    public function index(){
        return view('pelanggan.dashboard.dashboard');
    }
}
