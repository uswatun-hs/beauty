<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = ['nama', 'gambar', 'harga', 'deskripsi', 'karyawan_id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}

