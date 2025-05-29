<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('himpunans', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key
            $table->string('nama')->unique(); // Nama lengkap himpunan (misal: "Himpunan Mahasiswa Teknik Informatika")
            $table->string('singkatan')->unique()->nullable(); // Singkatan himpunan (misal: "HMIF")
            $table->text('deskripsi')->nullable(); // Deskripsi singkat tentang himpunan
            $table->string('logo')->nullable(); // Path atau URL logo himpunan (opsional)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('himpunans');
    }
};