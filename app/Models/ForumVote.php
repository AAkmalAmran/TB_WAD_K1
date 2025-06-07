<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumVote extends Model
{
    protected $fillable = ['user_id', 'forum_id', 'type'];
}