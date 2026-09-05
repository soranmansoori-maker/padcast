<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['podcast_id','user_id'];

    public function Podcast()
    {
        return $this->belongsTo(Podcast::class, 'podcast_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
