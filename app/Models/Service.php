<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'sort_order',
        'title_fr',
        'title_en',
        'description_fr',
        'description_en'
    ];

    protected $appends = ['title_fr', 'title_en', 'description_fr', 'description_en', 'image_url'];

    // --- ACCESSEURS TRADUCTION ---
    public function getTitleFrAttribute()
    {
        return $this->getTranslation('title', 'fr', false);
    }
    public function setTitleFrAttribute($value)
    {
        $this->setTranslation('title', 'fr', $value);
    }

    public function getTitleEnAttribute()
    {
        return $this->getTranslation('title', 'en', false);
    }
    public function setTitleEnAttribute($value)
    {
        $this->setTranslation('title', 'en', $value);
    }

    public function getDescriptionFrAttribute()
    {
        return $this->getTranslation('description', 'fr', false);
    }
    public function setDescriptionFrAttribute($value)
    {
        $this->setTranslation('description', 'fr', $value);
    }

    public function getDescriptionEnAttribute()
    {
        return $this->getTranslation('description', 'en', false);
    }
    public function setDescriptionEnAttribute($value)
    {
        $this->setTranslation('description', 'en', $value);
    }

    // --- GESTION IMAGE (Compatible avec vos anciennes images assets/) ---
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        if (str_starts_with($this->image, 'assets/')) return asset($this->image);
        return asset('storage/' . $this->image);
    }
}
