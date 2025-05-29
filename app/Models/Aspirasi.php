<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'aspirasi'; // Nama tabel di database

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mahasiswa_nim', // NIM Mahasiswa
        'mahasiswa_nama', // Nama Mahasiswa (opsional, bisa dari relasi user)
        'himpunan_id', // ID Himpunan
        'judul', // Judul aspirasi
        'konten', // Isi aspirasi
        'status', // Contoh: 'pending', 'diterima', 'ditolak', 'diproses'
        'user_id', // ID User yang membuat aspirasi
    ];

    /**
     * Get the himpunan that owns the aspirasi.
     */
    public function himpunan()
    {
        return $this->belongsTo(Himpunan::class); // Asumsi ada model Himpunan
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Anda mungkin juga ingin menambahkan relasi ke model User jika ada sistem login
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'mahasiswa_nim', 'nim'); // Contoh jika NIM adalah primary key di User
    // }
}