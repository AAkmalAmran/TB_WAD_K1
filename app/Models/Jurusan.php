<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusans';

    protected $fillable = [
        'nama_jurusan',
        'fakultas_id',
    ];

    /**
     * Relasi ke model Fakultas.
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
