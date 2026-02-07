<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_fr', // Renommé
        'logo_en', // Ajouté
        'website',
        'is_visible',
        'sort_order',
    ];

    // Accesseur intelligent pour récupérer le bon logo automatiquement
    public function getLogoUrlAttribute()
    {
        $lang = app()->getLocale();

        // Si on est en anglais et qu'un logo EN existe, on le prend
        if ($lang == 'en' && !empty($this->logo_en)) {
            return asset('storage/' . $this->logo_en);
        }

        // Sinon (Français ou fallback), on prend le logo FR
        // S'il est vide, on peut retourner une image par défaut ou null
        return !empty($this->logo_fr) ? asset('storage/' . $this->logo_fr) : null;
    }
}
