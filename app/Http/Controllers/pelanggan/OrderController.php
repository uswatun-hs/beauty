<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan\Order;
use App\Models\pelanggan\OrderDetail;
use App\Models\pelanggan\Keranjang;

class OrderController extends Controller
{
    public function index()
    {
        // Misal tampilkan semua order user
        $orders = auth()->user()->orders()->with('orderDetails.layanan')->get();

        return view('pelanggan.order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'layanan_ids' => 'required|array|min:1',
            'layanan_ids.*' => 'exists:layanans,id',
        ], [
            'layanan_ids.required' => 'Pilih minimal satu layanan untuk dipesan.',
        ]);

        $user = auth()->user();

        // Buat order baru
        $order = new Order();
        $order->user_id = $user->id;
        $order->status = 'pending'; // contoh status
        $order->save();

        foreach ($request->layanan_ids as $layananId) {
            // Ambil data keranjang item
            $keranjangItem = Keranjang::where('user_id', $user->id)
                ->where('layanan_id', $layananId)
                ->first();

            if ($keranjangItem) {
                // Ambil harga dari relasi layanan, jika layanan ditemukan
                $harga = $keranjangItem->layanan ? $keranjangItem->layanan->harga : null;

                if ($harga === null) {
                    // Kalau harga masih null, skip atau handle error sesuai kebutuhan
                    continue;
                }

                // Simpan detail order
                OrderDetail::create([
                    'order_id' => $order->id,
                    'layanan_id' => $layananId,
                    'jumlah' => $keranjangItem->jumlah,
                    'harga' => $harga,
                ]);

                // Hapus keranjang setelah dipesan
                $keranjangItem->delete();
            }
        }

        return redirect()->route('pelanggan.keranjang.index')
            ->with('success', 'Pesanan berhasil dibuat.');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Kamu bisa tambah validasi, misalnya hanya user yang punya order yang bisa hapus
        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->delete();

        return redirect()->route('pelanggan.order.index')->with('success', 'Order berhasil dihapus.');
    }
}
