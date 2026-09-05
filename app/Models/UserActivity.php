<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_type',
        'subject_id',
        'action',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function record($user, $subjectType, $subjectId, $action = 'view', array $metadata = [])
    {
        if (! $user || ! $subjectType || ! $subjectId) {
            return null;
        }

        return self::create([
            'user_id' => $user->id,
            'subject_type' => strtolower((string) $subjectType),
            'subject_id' => $subjectId,
            'action' => strtolower((string) $action),
            'metadata' => $metadata,
        ]);
    }

    public function scopeForUser($query, $user)
    {
        if (! $user) {
            return $query->whereRaw('0 = 1');
        }

        return $query->where('user_id', $user->id);
    }
}
