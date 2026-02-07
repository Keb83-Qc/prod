<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // SI une langue est déjà en mémoire, on saute l'étape du choix
        if (session()->has('locale')) {
            session(['welcome_seen' => true]);
            return redirect()->route('home');
        }

        // SINON, on affiche la page de choix (landing)
        return view('landing'); // Assurez-vous que votre vue s'appelle bien 'landing.blade.php'
    }
}
