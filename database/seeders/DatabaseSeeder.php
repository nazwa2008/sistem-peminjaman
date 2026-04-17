<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Alat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::create([
            'name' => 'Admin Sipa',
            'email' => 'admin@sipa.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas Jaga',
            'email' => 'petugas@sipa.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
        ]);

        User::create([
            'name' => 'Budi Peminjam',
            'email' => 'budi@sipa.com',
            'password' => Hash::make('password123'),
            'role' => 'peminjam',
        ]);

        User::create([
            'name' => 'Siti Peminjam',
            'email' => 'siti@sipa.com',
            'password' => Hash::make('password123'),
            'role' => 'peminjam',
        ]);

        // Alat
        Alat::create([
            'nama_alat' => 'Proyektor Epson EB-X05',
            'kondisi' => 'Baik',
            'status' => 'tersedia'
        ]);

        Alat::create([
            'nama_alat' => 'Mic Wireless Shure',
            'kondisi' => 'Baik',
            'status' => 'tersedia'
        ]);

        Alat::create([
            'nama_alat' => 'Laptop Lenovo Thinkpad',
            'kondisi' => 'Baik',
            'status' => 'tersedia'
        ]);

        Alat::create([
            'nama_alat' => 'Kursi Lipat Chitose',
            'kondisi' => 'Baik',
            'status' => 'tersedia'
        ]);

        Alat::create([
            'nama_alat' => 'Kamera Canon EOS 80D',
            'kondisi' => 'Baik',
            'status' => 'tersedia'
        ]);
    }
}
