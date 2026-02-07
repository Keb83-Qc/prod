<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Storage; // <--- AJOUT IMPORTANT

class BlogPost extends Model
{
    use HasFactory;
    use HasTranslations;

    // --- LOGIQUE AUTOMATIQUE (NOUVEAU) ---
    // C'est ici qu'on surveille les changements de slug pour renommer l'image
    protected static function booted(): void
    {
        static::updating(function (BlogPost $post) {
            // 1. Si le slug a changé ET que l'image n'a pas changé (donc on veut renommer l'existante)
            if ($post->isDirty('slug') && !$post->isDirty('image') && !empty($post->image)) {

                // Sécurité : on ne touche pas aux images externes ou assets
                if (str_starts_with($post->image, 'http') || str_starts_with($post->image, 'assets')) {
                    return;
                }

                // 2. On récupère le nouveau slug FR
                $newSlug = $post->getTranslation('slug', 'fr');

                // 3. Config du disque
                $disk = Storage::disk('public');

                if ($disk->exists($post->image)) {
                    $extension = pathinfo($post->image, PATHINFO_EXTENSION);

                    // 4. Nouveau chemin : blog/nouveau-slug-timestamp.ext
                    $newName = 'blog/' . $newSlug . '-' . time() . '.' . $extension;

                    // 5. Renommage physique + Mise à jour BDD
                    if ($disk->move($post->image, $newName)) {
                        $post->image = $newName;
                    }
                }
            }
        });
    }

    // On déclare que ces colonnes sont en JSON dans la BDD
    public $translatable = ['title', 'slug', 'content', 'category'];

    protected $fillable = [
        'title',
        'slug',
        'slug_fr',
        'slug_en',
        'content',
        'image',
        'category',
        'author',
        'created_at',
        // Champs virtuels
        'title_fr',
        'title_en',
        'content_fr',
        'content_en',
        'category_fr'
    ];

    // On rend les champs virtuels visibles pour Filament
    protected $appends = ['title_fr', 'title_en', 'content_fr', 'content_en', 'category_fr', 'slug_fr', 'slug_en'];

    protected $casts = [
        'created_at' => 'datetime',
        'title' => 'array',
        'slug' => 'array',
        'content' => 'array',
        'category' => 'array',
        'image' => 'string',
    ];

    // --- LOGIQUE AUTOMATIQUE POUR LES CATÉGORIES ---
    const CATEGORY_MAPPING = [
        'Actualités' => 'News',
        'Assurance'  => 'Insurance',
        'Épargne'    => 'Savings',
        'Prêt & Hypothèque' => 'Mortgage',
        'Hypothèque' => 'Mortgage',
        'Conseils Financiers' => 'Financial Advice',
        'Vie de l\'entreprise' => 'Business Life',
    ];

    // --- ACCESSEURS MAGIQUES (CATÉGORIE) ---

    public function getCategoryFrAttribute()
    {
        return $this->getTranslation('category', 'fr', false);
    }

    public function setCategoryFrAttribute($value)
    {
        $this->setTranslation('category', 'fr', $value);

        if (isset(self::CATEGORY_MAPPING[$value])) {
            $this->setTranslation('category', 'en', self::CATEGORY_MAPPING[$value]);
        } else {
            $this->setTranslation('category', 'en', $value);
        }
    }

    // --- ACCESSEURS MAGIQUES (TITRE & CONTENU) ---

    public function getTitleFrAttribute()
    {
        return $this->getTranslation('title', 'fr', false);
    }
    public function setTitleFrAttribute($value)
    {
        $this->setTranslation('title', 'fr', $value);
    }

    public function getContentFrAttribute()
    {
        return $this->getTranslation('content', 'fr', false);
    }
    public function setContentFrAttribute($value)
    {
        $this->setTranslation('content', 'fr', $value);
    }

    public function getTitleEnAttribute()
    {
        return $this->getTranslation('title', 'en', false);
    }
    public function setTitleEnAttribute($value)
    {
        $this->setTranslation('title', 'en', $value);
    }

    public function getContentEnAttribute()
    {
        return $this->getTranslation('content', 'en', false);
    }
    public function setContentEnAttribute($value)
    {
        $this->setTranslation('content', 'en', $value);
    }
    public function getSlugFrAttribute()
    {
        return $this->getTranslation('slug', 'fr', false);
    }

    public function setSlugFrAttribute($value)
    {
        $this->setTranslation('slug', 'fr', $value);
    }

    public function getSlugEnAttribute()
    {
        return $this->getTranslation('slug', 'en', false);
    }

    public function setSlugEnAttribute($value)
    {
        $this->setTranslation('slug', 'en', $value);
    }

    public function getImageUrlAttribute()
    {
        $path = $this->image;

        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return asset('storage/' . $path);
    }

    public function getRouteKeyName()
    {
        if (request()->is('admin/*') || request()->is('livewire/*')) {
            return 'id';
        }
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (is_numeric($value) && (request()->is('admin/*') || request()->is('livewire/*'))) {
            return $this->where('id', $value)->firstOrFail();
        }

        $locale = app()->getLocale();
        return $this->where("slug->{$locale}", $value)->firstOrFail();
    }
}
