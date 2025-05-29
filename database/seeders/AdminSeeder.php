<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama_panjang' => 'Admin HMSI',
            'nama_panggilan' => 'HMSI',   
            'email' => 'hmsi@gmail.com',
            'nim' => '0000000001',
            'fakultas' => 'Fakultas Rekayasa Industri',          
            'jurusan' => 'Sistem Informasi',      
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),            
            'role' => 'admin',
        ]);
    }
}