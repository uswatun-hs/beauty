<?php

namespace App\Models\pelanggan;

use Illuminate\Database\Eloquent\Model;
use App\Models\pelanggan\Layanan;

class Ulasan extends Model
{
    protected $table = 'ulasans';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nama',
        'layanan_id',
        'rating',
        'ulasan',
        'tanggal',
    ];

    // Relasi ke model Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}
