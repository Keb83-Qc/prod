<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $lang = app()->getLocale();

        $query = BlogPost::query();

        // 1. Filtre Catégorie (Recherche dans le JSON)
        if ($category) {
            $query->where('category->' . $lang, 'like', "%{$category}%")
                ->orWhere('category->fr', 'like', "%{$category}%");
        }

        // 2. Filtre Recherche (Recherche dans titre et contenu JSON)
        if ($search) {
            $query->where(function ($q) use ($search, $lang) {
                $q->where('title->' . $lang, 'like', "%{$search}%")
                    ->orWhere('content->' . $lang, 'like', "%{$search}%")
                    ->orWhere('title->fr', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest()->paginate(6);

        // 3. Gestion des Titres
        $header_title = __('BlogController.index_title');
        $header_subtitle = __('BlogController.index_subtitle');

        if ($search) {
            $header_title = __('BlogController.search_title', ['term' => $search]);
        } elseif ($category) {
            $header_title = __('BlogController.category_title', ['category' => $category]);
        }

        return view('pages.blog', [
            'posts' => $posts,
            'search' => $search,
            'category' => $category,
            'header_title' => $header_title,
            'header_subtitle' => $header_subtitle,
            'header_bg' => asset('assets/img/Entete-page-blog1.jpg'),
            'title' => __('BlogController.meta_title')
        ]);
    }

    /**
     * Affiche l'article en utilisant le SLUG au lieu de l'ID
     */
    public function show($slug)
    {
        $lang = app()->getLocale();

        // 1. Chercher l'article par le slug dans la langue actuelle
        // Si non trouvé, on cherche dans la version FR par défaut
        $post = BlogPost::where('slug->' . $lang, $slug)
            ->orWhere('slug->fr', $slug)
            ->firstOrFail();

        // 2. Articles récents (exclure l'actuel)
        $recentPosts = BlogPost::where('id', '!=', $post->id)
            ->latest()
            ->take(5)
            ->get();

        // 3. Navigation (Précédent / Suivant basé sur l'ID technique)
        $prevPost = BlogPost::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $nextPost = BlogPost::where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        // 4. Image de fond
        $header_bg = $post->image_url ?: asset('assets/img/Entete-page-blog1.jpg');

        return view('pages.article', [
            'article' => $post,
            'recentPosts' => $recentPosts,
            'prevPost' => $prevPost,
            'nextPost' => $nextPost,
            'header_bg' => $header_bg,
            'title' => $post->title . ' | VIP GPI'
        ]);
    }
}
