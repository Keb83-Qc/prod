<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; // Si vous utilisez les traductions

class Event extends Model
{
    use HasFactory;
    // use HasTranslations; // Décommentez si vous utilisez Spatie

    protected $fillable = [
        'title',
        'description',
        'slug',
        'event_date',
        'start_time',
        'end_time',
        'is_internal',
        'location',
        'image',
        'registration_link',
        'sort_order',
        'is_active',
    ];

    // Important pour que $event->event_date soit traité comme une date carbone
    protected $casts = [
        'event_date' => 'date',
        'is_internal' => 'boolean',
        'is_active' => 'boolean',
        'title' => 'array',       // Si traduit
        'description' => 'array', // Si traduit
    ];

    // public $translatable = ['title', 'description']; // Si traduit
}
