<?php

namespace App\Http\Controllers\pelanggan;

use App\Models\pelanggan\Keranjang;
use App\Models\pelanggan\Layanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $keranjangs = Keranjang::with('layanan')->where('user_id', Auth::id())->get();
        } else {
            $keranjangs = collect(Session::get('keranjang', []));
        }

        return view('pelanggan.keranjang.index', compact('keranjangs'));
    }

    public function store(Request $request)
    {
        $layananId = $request->input('layanan_id');

        if (Auth::check()) {
            $layanan = Layanan::findOrFail($layananId); // ambil data layanan dulu

            $keranjang = Keranjang::firstOrNew([
                'user_id' => Auth::id(),
                'layanan_id' => $layananId,
            ]);
            $keranjang->jumlah += 1;
            $keranjang->harga = $layanan->harga; // simpan harga layanan saat ini
            $keranjang->save();
        } else {
            $keranjang = Session::get('keranjang', []);
            if (isset($keranjang[$layananId])) {
                $keranjang[$layananId]['jumlah'] += 1;
            } else {
                $layanan = Layanan::findOrFail($layananId);
                $keranjang[$layananId] = [
                    'layanan_id' => $layanan->id,
                    'nama' => $layanan->nama,
                    'harga' => $layanan->harga,
                    'jumlah' => 1,
                ];
            }
            Session::put('keranjang', $keranjang);
        }

        return back()->with('success', 'Layanan ditambahkan ke keranjang');
    }


    public function destroy($id)
    {
        if (Auth::check()) {
            Keranjang::where('layanan_id', $id)->where('user_id', Auth::id())->delete();
        } else {
            $keranjang = Session::get('keranjang', []);
            unset($keranjang[$id]);
            Session::put('keranjang', $keranjang);
        }

        return back()->with('success', 'Item keranjang dihapus');
    }

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $keranjang = Keranjang::where('layanan_id', $id)->where('user_id', Auth::id())->first();
            if ($keranjang) {
                if ($request->action === 'increase') {
                    $keranjang->jumlah += 1;
                } elseif ($request->action === 'decrease' && $keranjang->jumlah > 1) {
                    $keranjang->jumlah -= 1;
                }
                $keranjang->save();
            }
        } else {
            $keranjang = session()->get('keranjang', []);
            if (isset($keranjang[$id])) {
                if ($request->action === 'increase') {
                    $keranjang[$id]['jumlah']++;
                } elseif ($request->action === 'decrease' && $keranjang[$id]['jumlah'] > 1) {
                    $keranjang[$id]['jumlah']--;
                }
                session()->put('keranjang', $keranjang);
            }
        }

        return back()->with('success', 'Jumlah layanan berhasil diperbarui.');
    }
}
