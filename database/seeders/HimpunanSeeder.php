<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HimpunanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('himpunans')->insert([
            [
                'nama' => 'Himpunan Mahasiswa Teknik Elektro',
                'singkatan' => 'HMTE',
                'deskripsi' => 'Himpunan mahasiswa jurusan Teknik Elektro.',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Himpunan Mahasiswa Teknik Mesin',
                'singkatan' => 'HMTM',
                'deskripsi' => 'Himpunan mahasiswa jurusan Teknik Mesin.',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Himpunan Mahasiswa Sistem Informasi',
                'singkatan' => 'HMSI',
                'deskripsi' => 'Himpunan mahasiswa jurusan Sistem Informasi.',
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}