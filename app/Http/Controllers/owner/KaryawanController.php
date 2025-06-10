<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = [
            'no' => 1,
            'karyawans' => Karyawan::all()
        ];
        return view('owner.karyawan.index', $data);
    }
}
