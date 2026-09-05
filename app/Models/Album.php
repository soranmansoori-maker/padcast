<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'cover',
        'user',
    ];

    public function Podcasts()
    {
        return $this->hasMany('App\Models\Podcast', 'album');
    }

    public function Tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'album_tag', 'album_id', 'tag_id');
    }

    public function Category()
    {
        return $this->belongsTo('App\Models\Category', 'category', 'id');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user', 'id');
    }

    public function Comment()
    {
        return $this->hasMany('App\Models\Comment', 'album');
    }
}
