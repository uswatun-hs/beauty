<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Layanan;
class LayananController extends Controller
{
    public function index()
    {
        $data = [
            'no' => 1,
            'layanans' => Layanan::all()
        ];
        return view('owner.layanan.index', $data);
    }
}
