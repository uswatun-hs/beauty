<?php

namespace App\Http\Controller\pelanggan;

use App\Http\Controllers\Controller;
use App\Models\pelanggan\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function tambah(Request $request, $layanan_id)
    {
        $carts = Cart::firstOrNew([
            'user_id' => auth()->id(),
            'layanan_id' => $layanan_id,
        ]);

        $cart->jumlah += 1;
        $cart->save();

        return redirect()->back()->with('success', 'Layanan ditambahkan ke keranjang.');
    }
    public function index()
    {
        $items = Cart::with('layanan')->where('user_id', auth()->id())->get();
        return view('pelanggan.cart.index', compact('items'));
    }
}
