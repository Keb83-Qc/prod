<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slide;
use App\Models\Service;
use App\Models\HomepageStat;
use App\Models\BlogPost;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Vérification de l'intro
        if (!session()->has('welcome_seen')) {
            return redirect()->route('landing');
        }

        // --- CORRECTION ICI ---
        // On NE TOUCHE PLUS à la langue ici. Le Middleware s'en est déjà occupé.
        // On a juste besoin de savoir quelle est la langue actuelle pour le titre.

        $currentLocale = app()->getLocale(); // On demande à Laravel : "Quelle langue as-tu choisie ?"

        $title = ($currentLocale == 'en') ? "Home - VIP GPI" : "Accueil - VIP GPI";

        // 3. Récupération des données
        // Note: Si vos modèles (Slide, Service, etc.) utilisent Spatie Translatable,
        // ils utiliseront automatiquement $currentLocale pour choisir le bon texte.

        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        $slides = Slide::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $services = Service::orderBy('sort_order')->get();
        $stats = HomepageStat::orderBy('sort_order')->get();

        $posts = BlogPost::latest()
            ->take(3)
            ->get();

        // 4. On envoie à la vue
        // On retire 'lang' de compact() car on peut utiliser app()->getLocale() dans la vue si besoin
        return view('home', compact('services', 'stats', 'testimonials', 'posts', 'title', 'slides'));
    }
}