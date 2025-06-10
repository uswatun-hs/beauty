<?php

namespace App\Http\Controllers\karyawan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan\Ulasan;
class UlasanController extends Controller
{
   public function index(){
    $data = [
        'no' => 1,
        'ulasan' => Ulasan::all()
    ];
    return view('karyawan.ulasan.index', $data);
    }
}
