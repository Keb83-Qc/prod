<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomepageStat extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'homepage_stats'; // On force le nom de la table

    public $translatable = ['label'];

    protected $fillable = [
        'value',
        'suffix',
        'label',
        'sort_order',
        'label_fr',
        'label_en'
    ];

    protected $appends = ['label_fr', 'label_en'];

    // --- ACCESSEURS TRADUCTION ---
    public function getLabelFrAttribute()
    {
        return $this->getTranslation('label', 'fr', false);
    }
    public function setLabelFrAttribute($value)
    {
        $this->setTranslation('label', 'fr', $value);
    }

    public function getLabelEnAttribute()
    {
        return $this->getTranslation('label', 'en', false);
    }
    public function setLabelEnAttribute($value)
    {
        $this->setTranslation('label', 'en', $value);
    }
}
