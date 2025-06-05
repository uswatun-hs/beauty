<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan\Cart;
use App\Models\pelanggan\Order;
use App\Models\pelanggan\OrderItem;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_pelanggan'   => 'required|string|max:100',
            'no_telepon'       => 'required|string|max:20',
            'tempat_layanan'   => 'required|in:salon,rumah',
            'alamat'           => 'nullable|string|max:255',
        ]);

        // Ambil data keranjang
        $items = Cart::with('layanan')->where('user_id', auth()->id())->get();

        if ($items->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Hitung total harga
        $total = $items->sum(function ($item) {
            return $item->layanan->harga * $item->jumlah;
        });

        // Simpan data order
        $order = Order::create([
            'user_id'         => auth()->id(),
            'total_harga'     => $total,
            'status'          => 'menunggu',
            'nama_pelanggan'  => $request->nama_pelanggan,
            'no_telepon'      => $request->no_telepon,
            'tempat_layanan'  => $request->tempat_layanan,
            'alamat'          => $request->tempat_layanan === 'rumah' ? $request->alamat : null,
        ]);

        // Simpan item order satu per satu
        foreach ($items as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'layanan_id'    => $item->layanan_id,
                'jumlah'        => $item->jumlah,
                'harga_satuan'  => $item->layanan->harga,
            ]);
        }

        // Hapus keranjang setelah checkout
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('pelanggan.orders')->with('success', 'Pesanan berhasil dibuat.');
    }
}
