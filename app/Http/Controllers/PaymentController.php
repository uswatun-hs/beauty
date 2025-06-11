<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\pelanggan\Order;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        Config::$is3ds = config('midtrans.is_3ds', true);
    }

    public function form($orderId)
    {
        $order = Order::with('orderDetails.layanan')->findOrFail($orderId);
        return view('pelanggan.order.paymentForm', compact('order'));
    }

    public function process(Request $request, $orderId)
    {
        $order = Order::with('orderDetails.layanan')->findOrFail($orderId);

        $total = $order->orderDetails->sum(fn($d) => $d->jumlah * $d->harga);

        $payload = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
            'item_details' => $order->orderDetails->map(function ($item) {
                return [
                    'id' => $item->layanan_id,
                    'price' => $item->harga,
                    'quantity' => $item->jumlah,
                    'name' => $item->layanan->nama,
                ];
            })->toArray()
        ];

        $snapToken = Snap::getSnapToken($payload);

        return view('pelanggan.order.checkout', [
            'snapToken' => $snapToken,
            'order' => $order,
        ]);
    }

    public function handleNotification(Request $request)
    {
        $notification = new Notification();

        $realOrderId = explode('-', $notification->order_id)[1]; // ambil ID dari "ORDER-123-..."
        $order = Order::find($realOrderId);

        if (!$order) return response()->json(['status' => 'Order Not Found'], 404);

        $order->update([
            'payment_status' => $notification->transaction_status,
            'payment_type' => $notification->payment_type,
            'gross_amount' => $notification->gross_amount,
            'transaction_time' => $notification->transaction_time,
            'midtrans_order_id' => $notification->order_id,
        ]);

        switch ($notification->transaction_status) {
            case 'settlement':
                $order->status = 'menunggu_konfirmasi';
                break;
            case 'expire':
            case 'cancel':
            case 'deny':
                $order->status = 'dibatalkan';
                break;
        }

        $order->save();

        return response()->json(['status' => 'OK']);
    }
}
