<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Himpunan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'himpunans'; // Pastikan nama tabel ini sesuai dengan tabel di database Anda

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',        // Nama lengkap himpunan (misal: "Himpunan Mahasiswa Teknik Elektro")
        'singkatan',   // Singkatan himpunan (misal: "HME")
        'deskripsi',   // Deskripsi singkat tentang himpunan
        'logo',        // Path atau URL logo himpunan (opsional)
    ];

    /**
     * Get the aspirasis for the himpunan.
     * Mendefinisikan relasi "one-to-many" dengan model Aspirasi.
     * Satu Himpunan bisa memiliki banyak Aspirasi.
     */
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'himpunan_id');
    }
}