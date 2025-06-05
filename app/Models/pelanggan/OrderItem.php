<?php

namespace App\Models\pelanggan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'layanan_id',
        'jumlah',
        'harga_satuan',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
