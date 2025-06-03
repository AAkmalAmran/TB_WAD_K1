<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'user_id', 'judul', 'isi', 'jumlah_komentar', 'jumlah_view'
    ];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'berita_id');
    }
}
