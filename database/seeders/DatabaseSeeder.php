<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\HimpunanSeeder;
use Database\Seeders\FakultasSeeder;
use Database\Seeders\JurusanSeeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FakultasSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(HimpunanSeeder::class);

    }
}
