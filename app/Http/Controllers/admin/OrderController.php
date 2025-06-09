<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\pelanggan\OrderDetail;
use App\Models\pelanggan\Order;

class OrderController extends Controller
{

    public function index()
{
    // urut berdasarkan created_at descending (pesanan terbaru di atas)
    $orders = Order::with(['user', 'orderDetails.layanan'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('admin.order.index', compact('orders'));
}


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        if ($request->status === 'diterima') {
            $order->status = 'menunggu_pembayaran'; // langsung ganti status
        } else {
            $order->status = 'ditolak';
        }

        $order->save();

        return redirect()->route('admin.order.index')->with('success', 'Status pesanan diperbarui.');
    }

    public function konfirmasiPembayaran(Order $order)
    {
        $order->status = 'sudah_bayar';
        $order->save();

        return back()->with('success', 'Pembayaran telah dikonfirmasi.');
    }

}
