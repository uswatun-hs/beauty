<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan\Order;
class OrderController extends Controller
{
    public function index()
{
    // urut berdasarkan created_at descending (pesanan terbaru di atas)
    $orders = Order::with(['user', 'orderDetails.layanan'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('owner.order.index', compact('orders'));
}

    public function konfirmasiPembayaran(Order $order)
    {
        $order->status = 'sudah_bayar';
        $order->save();

        return back()->with('success', 'Pembayaran telah dikonfirmasi.');
    }
}
