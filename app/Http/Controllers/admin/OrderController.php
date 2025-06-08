<?php

namespace App\Http\Controllers\admin;
use App\Models\User;
use App\Models\pelanggan\OrderDetail;


use App\Http\Controllers\Controller;
use App\Models\pelanggan\Order;

class OrderController extends Controller
{
    public function index()
    {
        // ambil semua pesanan beserta detail dan user
        $orders = Order::with(['user', 'orderDetails.layanan'])->latest()->paginate(10);

        return view('admin.order.index', compact('orders'));
    }
    public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:diterima,ditolak',
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.order.index')->with('success', 'Status pesanan diperbarui.');
}

}
