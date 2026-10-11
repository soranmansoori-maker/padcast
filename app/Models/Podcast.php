<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'album',
        'cover',
        'file',
        'status',
        'user',
    ];

    public function Album()
    {
        return $this->belongsTo('App\Models\Album', 'album', 'id');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user', 'id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'podcast_id');
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

}
