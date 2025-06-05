<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Karyawan extends Model
{
   use HasFactory;

    protected $fillable = ['nama', 'email', 'telepon', 'jenis_kelamin', 'alamat', 'foto'];
}
