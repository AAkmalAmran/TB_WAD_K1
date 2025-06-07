<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Fakultas;
use App\Models\Jurusan;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin HMSI (FRI - Sistem Informasi)
        $fakultasFRI = Fakultas::where('nama_fakultas', 'Fakultas Rekayasa Industri')->first();
        $jurusanSI = Jurusan::where('nama_jurusan', 'S1 Sistem Informasi')->first();

        User::create([
            'nama_panjang' => 'Admin HMSI',
            'nama_panggilan' => 'HMSI',   
            'email' => 'hmsi@gmail.com',
            'nim' => '0000000001',
            'fakultas_id' => $fakultasFRI ? $fakultasFRI->id : null,
            'jurusan_id' => $jurusanSI ? $jurusanSI->id : null,
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),            
            'role' => 'admin',
        ]);

        // Admin HMTE (FTE - Teknik Elektro)
        $fakultasFTE = Fakultas::where('nama_fakultas', 'Fakultas Teknik Elektro')->first();
        $jurusanTE = Jurusan::where('nama_jurusan', 'S1 Teknik Elektro')->first();

        User::create([
            'nama_panjang' => 'Admin HMTE',
            'nama_panggilan' => 'HMTE',   
            'email' => 'hmte@gmail.com',
            'nim' => '0000000002',
            'fakultas_id' => $fakultasFTE ? $fakultasFTE->id : null,
            'jurusan_id' => $jurusanTE ? $jurusanTE->id : null,
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),            
            'role' => 'admin',
        ]);
        
    }
}