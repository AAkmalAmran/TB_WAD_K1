<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fakultas')->insert([
            [
                'nama_fakultas' => 'Fakultas Industri Kreatif',
                'kode_fakultas' => 'FIK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fakultas' => 'Fakultas Komunikasi dan Bisnis',
                'kode_fakultas' => 'FKB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fakultas' => 'Fakultas Ekonomi dan Bisnis',
                'kode_fakultas' => 'FEB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fakultas' => 'Fakultas Rekayasa Industri',
                'kode_fakultas' => 'FRI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fakultas' => 'Fakultas Informatika',
                'kode_fakultas' => 'FIF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fakultas' => 'Fakultas Teknik Elektro',
                'kode_fakultas' => 'FTE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fakultas' => 'Fakultas Ilmu Terapan',
                'kode_fakultas' => 'FIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
