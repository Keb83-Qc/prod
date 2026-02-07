<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamTitle extends Model
{
    protected $fillable = ['name'];

    protected $casts = [
        'name' => 'array', // On utilise array pour que Filament puisse écrire dans name.fr
    ];

    public function getLabelAttribute(): ?string
    {
        $locale = app()->getLocale(); // 'fr' ou 'en'
        $name = $this->name;

        if (is_array($name)) {
            return $name[$locale] ?? $name['fr'] ?? $name['en'] ?? null;
        }

        return is_string($name) ? $name : null;
    }
}
