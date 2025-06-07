<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['isi', 'user_id', 'aspirasi_id'];

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class, 'aspirasi_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}