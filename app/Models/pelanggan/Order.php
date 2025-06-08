<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggan\Layanan; // pastikan foldernya dan nama kelas benar
use App\Models\User; // perlu import User juga supaya relasi user() berfungsi

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'layanan_id',
        'jumlah',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
