<?php

namespace App\Models\pelanggan;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    // Tabel yang digunakan tetap 'layanans' (sesuai tabel di DB)
    protected $table = 'layanans';

    protected $fillable = ['nama', 'gambar', 'harga', 'deskripsi', 'karyawan_id'];

    public function karyawan()
    {
        // Jika Karyawan model juga di namespace admin, panggil full namespace
        return $this->belongsTo(\App\Models\admin\Karyawan::class);
    }
   

}
