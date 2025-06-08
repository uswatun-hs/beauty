<?php

namespace App\Models\pelanggan;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjangs'; // sesuaikan dengan nama tabel

    protected $fillable = [
        'user_id',
        'layanan_id',
        'jumlah',
        'harga',
        // kolom lain jika ada
    ];

    // Relasi ke layanan
    public function layanan()
    {
        return $this->belongsTo(\App\Models\pelanggan\Layanan::class, 'layanan_id');
    }
}
