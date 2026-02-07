<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slide extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'subtitle', 'button_text'];

    // 1. AJOUTEZ CETTE PROPRIÉTÉ MAGIQUE (C'est elle qui fait apparaître le texte !)
    protected $appends = [
        'title_fr',
        'title_en',
        'subtitle_fr',
        'subtitle_en',
        'button_text_fr',
        'button_text_en'
    ];

    // 2. METTEZ À JOUR $fillable AVEC LES NOUVEAUX CHAMPS
    protected $fillable = [
        'title_fr',
        'title_en',          // <--- Ajouté
        'subtitle_fr',
        'subtitle_en',    // <--- Ajouté
        'button_text_fr',
        'button_text_en', // <--- Ajouté
        'image',
        'button_link',
        'sort_order',
        'is_active',
        // Note: On garde aussi les champs originaux au cas où
        'title',
        'subtitle',
        'button_text'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ... Vos fonctions (getTitleFrAttribute, etc.) restent en bas, ne les touchez pas ...

    public function getTitleFrAttribute()
    {
        return $this->getTranslation('title', 'fr', false);
    }

    public function setTitleFrAttribute($value)
    {
        $this->setTranslation('title', 'fr', $value);
    }

    public function getSubtitleFrAttribute()
    {
        return $this->getTranslation('subtitle', 'fr', false);
    }

    public function setSubtitleFrAttribute($value)
    {
        $this->setTranslation('subtitle', 'fr', $value);
    }

    public function getButtonTextFrAttribute()
    {
        return $this->getTranslation('button_text', 'fr', false);
    }

    public function setButtonTextFrAttribute($value)
    {
        $this->setTranslation('button_text', 'fr', $value);
    }

    // --- ACCESSEURS & MUTATEURS POUR L'ANGLAIS ---

    public function getTitleEnAttribute()
    {
        return $this->getTranslation('title', 'en', false);
    }

    public function setTitleEnAttribute($value)
    {
        $this->setTranslation('title', 'en', $value);
    }

    public function getSubtitleEnAttribute()
    {
        return $this->getTranslation('subtitle', 'en', false);
    }

    public function setSubtitleEnAttribute($value)
    {
        $this->setTranslation('subtitle', 'en', $value);
    }

    public function getButtonTextEnAttribute()
    {
        return $this->getTranslation('button_text', 'en', false);
    }

    public function setButtonTextEnAttribute($value)
    {
        $this->setTranslation('button_text', 'en', $value);
    }
}
