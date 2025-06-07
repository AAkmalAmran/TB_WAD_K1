<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'forum'; 
    protected $fillable = [
        'judul',
        'kategori',
        'isi',
        'user_id',
        'upvote',
        'downvote',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
