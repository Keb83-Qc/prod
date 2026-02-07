<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeamTitle;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        // 1. Récupération des villes
        $cities = User::query()
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->where('position', '!=', 0)
            ->whereHas('role', function ($q) {
                $q->where('name', 'not like', '%Candidat%');
            })
            ->distinct()
            ->orderBy('city', 'asc')
            ->pluck('city');

        // 2. Récupération des membres
        $query = User::with(['title', 'role'])
            ->where('position', '!=', 0)
            ->whereHas('role', function ($q) {
                $q->where('name', 'not like', '%Candidat%');
            });

        // FILTRE VILLE (Existant)
        if ($request->has('ville') && !empty($request->ville)) {
            $query->where('city', $request->ville);
        }

        // --- FILTRE LANGUE (NOUVEAU) ---
        if ($request->has('langue') && !empty($request->langue)) {
            // whereJsonContains est magique : il cherche si 'en' existe dans le tableau ['fr', 'en']
            $query->whereJsonContains('languages', $request->langue);
        }

        $members = $query->orderBy('position', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();

        // 3. Retour à la vue avec TRADUCTIONS
        return view('pages.equipe', [
            'cities' => $cities,
            'members' => $members,
            'selected_city' => $request->ville,
            'selected_lang' => $request->langue, // On passe la langue sélectionnée à la vue
            'available_languages' => User::getAvailableLanguages(),

            // Variables traduites ici
            'header_title' => __('TeamController.header_title'),
            'header_subtitle' => __('TeamController.header_subtitle'),
            'header_bg' => asset('assets/img/canvas.png'),
            'title' => __('TeamController.meta_title')
        ]);
    }

    public function show($slug)
    {
        $member = User::with(['title', 'role'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Le titre/rôle est géré par la base de données (JSON), donc auto-traduit par le modèle
        $display_role = $member->title ? $member->title->title_name : ($member->role->name ?? 'Conseiller');
        $full_name = $member->first_name . " " . $member->last_name;

        return view('pages.team_detail', [
            'member' => $member,
            'display_role' => $display_role,
            'full_name' => $full_name,

            // Ces variables restent dynamiques (basées sur le nom de la personne)
            'header_title' => $full_name,
            'header_subtitle' => $display_role,
            'header_bg' => asset('assets/img/canvas.png'),
            'title' => $full_name . " - " . $display_role
        ]);
    }
}