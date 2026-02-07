<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleReview extends Model
{
    protected $fillable = [
        'google_review_id',
        'author_name',
        'author_photo_url',
        'rating',
        'text',
        'language',
        'review_time',
        'is_visible',
    ];

    protected $casts = [
        'review_time' => 'datetime',
        'is_visible' => 'boolean',
    ];

    // Scope pratique pour récupérer seulement les avis à afficher
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true)->orderBy('review_time', 'desc');
    }
}
