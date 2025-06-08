<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\pelanggan\Keranjang;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil semua order milik user yang login dengan relasi layanan, urut berdasarkan terbaru
        $orders = Order::where('user_id', Auth::id())->with('layanan')->latest()->get();
        return view('pelanggan.order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'layanan_ids' => 'required|array|min:1',
        ]);

        // Buat order untuk setiap layanan yang dipilih, lalu hapus dari keranjang
        foreach ($request->layanan_ids as $layananId) {
            $item = Keranjang::where('user_id', Auth::id())
                            ->where('layanan_id', $layananId)
                            ->first();
            if ($item) {
                Order::create([
                    'user_id' => Auth::id(),
                    'layanan_id' => $item->layanan_id,
                    'jumlah' => $item->jumlah,
                    'status' => 'pending', // status default saat order dibuat
                ]);
                $item->delete(); // hapus item dari keranjang setelah dibuat order
            }
        }

        return redirect()->route('pelanggan.order.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Cek jika status bukan pending, tidak bisa dibatalkan
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan tidak bisa dibatalkan.');
        }

        $order->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
