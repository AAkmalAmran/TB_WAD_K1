<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusans')->insert([
            [
                'nama_jurusan' => 'S1 Sistem Informasi',
                'fakultas_id' => 4, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Teknik Industri',
                'fakultas_id' => 4, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Teknik Logistik',
                'fakultas_id' => 4, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Informatika',
                'fakultas_id' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Teknologi Informasi',
                'fakultas_id' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Rekayasa Perangkat Lunak',
                'fakultas_id' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Sains Data',
                'fakultas_id' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Teknik Elektro',
                'fakultas_id' => 6, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Teknik Telekomunikasi',
                'fakultas_id' => 6, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Teknik Komputer',
                'fakultas_id' => 6, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Administrasi Bisnis',
                'fakultas_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Akuntansi',
                'fakultas_id' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'S1 Desain Komunikasi Visual',
                'fakultas_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'D3 Sistem Informasi',
                'fakultas_id' => 7, 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
                
        ]);
    }
}
