<?php

namespace App\Models\pelanggan;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Tambahkan ini
use App\Models\pelanggan\OrderDetail;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'payment_status',
        'payment_type',
        'midtrans_order_id',
        'gross_amount',
        'transaction_time',
        'bukti_pembayaran'
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
