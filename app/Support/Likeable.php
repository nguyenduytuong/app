<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

trait Likeable
{
    public function getLikedByAuthUserAttribute()
    {
        $userId = auth()->user()?->id;
        if (!$userId) {
            return false;
        }

        return $this->likes->contains(function ($like, $key) use ($userId) {
            return $like->source_type == 'user' && $like->source_id == $userId;
        });
    }
}
