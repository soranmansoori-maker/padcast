<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'album',
        'user',
        'parent',
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user', 'id');
    }

    public function Album()
    {
        return $this->belongsTo('App\Models\Album', 'album', 'id');
    }
}
