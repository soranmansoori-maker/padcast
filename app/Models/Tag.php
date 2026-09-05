<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function Albums()
    {
        return $this->belongsToMany(Album::class, 'album_tag', 'tag_id', 'album_id');
    }
}
