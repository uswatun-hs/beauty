<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('owner123'),
            'role' => 'owner',
        ]);

        User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('karyawand123'),
            'role' => 'karyawan',
        ]);

        User::create([
            'name' => 'Pelanggan',
            'email' => 'pelanggan@gmail.com',
            'password' => Hash::make('pelanggan123'),
            'role' => 'pelanggan',
        ]);
        User::create([
            'name' => 'Uswatun Hasanah',
            'email' => 'uswatun@gmail.com',
            'password' => Hash::make('uswatun123'),
            'role' => 'pelanggan',
        ]);
        User::create([
            'name' => 'Holiviana',
            'email' => 'holiviana@gmail.com',
            'password' => Hash::make('holiviana123'),
            'role' => 'pelanggan',
        ]);
        User::create([
            'name' => 'Wahyu',
            'email' => 'wahyu@gmail.com',
            'password' => Hash::make('wahyu123'),
            'role' => 'pelanggan',
        ]);
        User::create([
            'name' => 'sahrul',
            'email' => 'sahrul@gmail.com',
            'password' => Hash::make('sahrul123'),
            'role' => 'pelanggan',
        ]);
    }
}
