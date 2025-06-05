<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = ['nama', 'gambar', 'harga', 'deskripsi', 'karyawan_id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}

