<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';

    protected $fillable = [
        'nama_fakultas',
        'kode_fakultas',
    ];

    /**
     * Relasi ke model Jurusan.
     */
    public function jurusan()
    {
        return $this->hasMany(Jurusan::class);
    }
}
