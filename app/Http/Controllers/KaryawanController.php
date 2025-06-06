<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function dashboard()
    {
        return view('karyawan.dashboard');
    }
}
