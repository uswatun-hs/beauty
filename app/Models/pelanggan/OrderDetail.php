<?php

namespace App\Models\pelanggan;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'layanan_id', 'jumlah', 'harga'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
