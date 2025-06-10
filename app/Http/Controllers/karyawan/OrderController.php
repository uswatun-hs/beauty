<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan\Order;
use App\Models\User;
use App\Models\pelanggan\OrderDetail;

class OrderController extends Controller
{

    public function index()
    {
        $karyawan = auth()->user()->karyawan;

        if (!$karyawan) {
            return abort(403, 'Karyawan tidak ditemukan.');
        }

        // Ambil semua ID layanan yang dimiliki karyawan ini
        $layananIds = $karyawan->layanans->pluck('id');

        // Ambil hanya pesanan yang detailnya terkait layanan milik karyawan ini
        $orders = Order::whereHas('orderDetails', function ($query) use ($layananIds) {
            $query->whereIn('layanan_id', $layananIds);
        })
            ->with(['user', 'orderDetails.layanan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('karyawan.order.index', compact('orders'));
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

        return redirect()->route('karyawan.order.index')->with('success', 'Status pesanan diperbarui.');
    }

    public function konfirmasiPembayaran(Order $order)
    {
        $order->status = 'sudah_bayar';
        $order->save();

        return back()->with('success', 'Pembayaran telah dikonfirmasi.');
    }
}
