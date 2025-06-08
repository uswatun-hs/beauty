<?php

namespace App\Models\pelanggan;

use Illuminate\Database\Eloquent\Model;
use App\Models\pelanggan\Layanan;
use App\Models\User;

class Keranjang extends Model
{
    protected $fillable = ['user_id', 'layanan_id', 'jumlah'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
