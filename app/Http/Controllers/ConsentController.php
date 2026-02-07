<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ConsentController extends Controller
{
    // --- 1. CHANGER LA LANGUE ---
    public function switchLanguage($locale, $advisorCode = null)
    {
        // Valider les langues acceptées (fr, en, ht = Haïtien/Créole)
        if (in_array($locale, ['fr', 'en', 'ht'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }

        // Rediriger vers la page de consentement avec le code conseiller
        return redirect()->route('consent.show', ['code' => $advisorCode]);
    }

    // --- 2. AFFICHER LA PAGE (FUSIONNÉE) ---
    public function show($advisorCode = null)
    {
        // A. Appliquer la langue stockée en session (Important pour le trilingue)
        app()->setLocale(session('locale', 'fr'));

        // B. Recherche du conseiller
        $advisor = User::where('advisor_code', $advisorCode)->first();

        // Si introuvable, on met Claude par défaut (ID 1)
        if (!$advisor) {
            $advisor = User::find(1);
        }

        // C. Gestion de la Session
        session([
            'current_advisor_code' => $advisor->advisor_code,
            'has_consented' => false // On réinitialise le consentement à l'arrivée sur la page
        ]);

        // D. PRÉPARATION DES DONNÉES POUR LA TOP BAR
        // On formate le nom complet et on s'assure d'avoir un téléphone
        $advisorName = $advisor->first_name . ' ' . $advisor->last_name;
        $advisorPhone = $advisor->phone ?? '1-888-123-4567'; // Numéro par défaut si vide

        // E. On envoie tout à la vue 'consentement'
        return view('consentement', compact('advisor', 'advisorName', 'advisorPhone'));
    }

    // --- 3. ACCEPTER LE CONSENTEMENT ---
    public function accept(Request $request)
    {
        session(['has_consented' => true]);
        return redirect()->route('quote.auto'); // Redirection vers le formulaire auto
    }
}