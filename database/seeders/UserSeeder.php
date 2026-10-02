<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun ADMIN UTAMA (Login pakai username: admin)
        User::create([
            'nik' => '11111',               // Kolom Baru: NIK
            'name' => 'Admin Utama',
            'username' => 'admin',          // Kolom Baru: Username (Login pakai ini!)
            'email' => 'admin@sigap.com',
            'password' => Hash::make('password'),
            'telp' => '08123456789',        // Kolom Baru: Telp
            'role' => 'admin',
        ]);

        // 2. Akun WARGA CONTOH (Login pakai username: warga)
        User::create([
            'nik' => '32010001',
            'name' => 'Warga Test',
            'username' => 'warga', // Username untuk warga
            'email' => 'warga@sigap.com',
            'password' => Hash::make('password'),
            'telp' => '08987654321',
            'role' => 'masyarakat',
        ]);
    }
}
