<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'title', 'description', 'genre', 'release_year',
        'poster_url', 'trailer_url', 'download_url',
        'avg_rating', 'ratings_count'
    ];

    protected $casts = [
        'avg_rating' => 'decimal:2',
        'release_year' => 'integer',
    ];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function userRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }
}
