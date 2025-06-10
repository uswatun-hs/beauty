<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email', 'telepon', 'jenis_kelamin', 'alamat', 'foto'];
    public function layanans()
{
    return $this->hasMany(Layanan::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}


}
