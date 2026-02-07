<?php

namespace App\View\Components;

use App\Models\BlogPost;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class BlogSection extends Component
{
    public $title;
    public $subtitle;
    public $category;
    public $limit;
    public $posts;

    /**
     * Create a new component instance.
     *
     * @param string|null $title Titre personnalisé (optionnel)
     * @param string|null $subtitle Sous-titre (optionnel)
     * @param string|null $category Filtrer par catégorie (ex: 'Épargne')
     * @param int $limit Nombre d'articles à afficher
     */
    public function __construct($title = null, $subtitle = null, $category = null, $limit = 3)
    {
        // 1. Définition des textes par défaut ou personnalisés
        $this->title = $title ?? __('home.blog_title'); // Par défaut : clé de traduction home
        $this->subtitle = $subtitle ?? __('home.blog_subtitle');
        $this->category = $category;
        $this->limit = $limit;

        // 2. Récupération "Intelligente" des articles
        $query = BlogPost::latest();

        // Si une catégorie est demandée (ex: sur la page épargne)
        if ($category) {
            // On cherche dans le JSON de la colonne category
            $query->where('category->fr', 'like', "%{$category}%")
                ->orWhere('category->en', 'like', "%{$category}%");
        }

        $this->posts = $query->take($limit)->get();
    }

    public function render()
    {
        return view('components.blog-section');
    }
}
