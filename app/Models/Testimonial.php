<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;

    // Seuls 'role' et 'content' sont JSON dans votre SQL
    public $translatable = ['role', 'content'];

    // Pour pouvoir remplir ces champs (si vous faites un formulaire d'admin plus tard)
    protected $fillable = ['name', 'role', 'content', 'image'];

    // On précise à Laravel que ces colonnes doivent être traitées comme des tableaux
    protected $casts = [
        'role' => 'array',
        'content' => 'array',
    ];
}
