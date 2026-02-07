<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsentController;

// 0. ROUTE POUR CHANGER LA LANGUE (Celle qu'on va utiliser sur la Landing)
Route::get('/switch-language/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'en', 'ht'])) {
        session([
            'locale' => $locale,
            'welcome_seen' => true // On stocke le choix
        ]);
        session()->save();
        app()->setlocale($locale);
    }
    return redirect()->back(); // On redirige vers le site principal
})->name('switch.language');

// 1. LANDING & ACCUEIL
Route::get('/', [WelcomeController::class, 'index'])->name('landing');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 2. PAGES STATIQUES (PageController)
Route::get('/about', [PageController::class, 'about'])->name('about');

// Menu Parent
Route::get('/assurance', [PageController::class, 'assurances'])->name('assurance');
Route::get('/epargne', [PageController::class, 'epargne'])->name('epargne');
Route::get('/pret', [PageController::class, 'prets'])->name('prets');
Route::get('/hypotheque', [PageController::class, 'hypotheque'])->name('hypotheque');

// Menu Enfant - Assurance
Route::get('/assurance-vie', [PageController::class, 'assuranceVie'])->name('assurance-vie');
Route::get('/assurance-maladie-grave', [PageController::class, 'assuranceMaladieGrave'])->name('assurance-maladie-grave');
Route::get('/assurance-invalidite', [PageController::class, 'assuranceInvalidite'])->name('assurance-invalidite');
Route::get('/assurance-dommages', [PageController::class, 'assuranceDommages'])->name('assurance-dommages');
Route::get('/assurance-voyage', [PageController::class, 'assuranceVoyage'])->name('assurance-voyage');
Route::get('/assurance-vie-hypothecaire', [PageController::class, 'assuranceVieHypothecaire'])->name('assurance-vie-hypothecaire');
Route::get('/assurance-complementaire-dentaire', [PageController::class, 'assuranceComplementaireDentaire'])->name('assurance-complementaire-dentaire');

// Menu Enfant - Assurance Invalité
Route::get('/assurance-invalidite-individuelle', [PageController::class, 'assuranceInvaliditeIndividuelle'])->name('assurance-invalidite-individuelle');
Route::get('/assurance-invalidite-de-groupe', [PageController::class, 'assuranceInvaliditeDeGroupe'])->name('assurance-invalidite-de-groupe');

// Menu Enfant - Assurance Dommages
Route::get('/assurance-auto', [PageController::class, 'assuranceAuto'])->name('assurance-auto');
Route::get('/assurance-habitation', [PageController::class, 'assuranceHabitation'])->name('assurance-habitation');
Route::get('/assurance-responsabilite-professionnelle', [PageController::class, 'assuranceResponsabilite'])->name('assurance-responsabilite-professionnelle');
Route::get('/assurance-commerciale', [PageController::class, 'assuranceCommerciale'])->name('assurance-commerciale');

// Menu Enfant - Épargne
Route::get('/reer', [PageController::class, 'reer'])->name('reer');
Route::get('/celi', [PageController::class, 'celi'])->name('celi');
Route::get('/celiapp', [PageController::class, 'celiapp'])->name('celiapp');
Route::get('/reei', [PageController::class, 'reei'])->name('reei');
Route::get('/rene', [PageController::class, 'rene'])->name('rene');
Route::get('/cri', [PageController::class, 'cri'])->name('cri');
Route::get('/frv', [PageController::class, 'frv'])->name('frv');
Route::get('/ferr', [PageController::class, 'ferr'])->name('ferr');
Route::get('/reee', [PageController::class, 'reee'])->name('reee');

// Menu Enfant - Prêt
Route::get('/pret-reer', [PageController::class, 'pretReer'])->name('pret-reer');
Route::get('/pret-reee', [PageController::class, 'pretReee'])->name('pret-reee');
Route::get('/pret-investissement', [PageController::class, 'pretInvestissement'])->name('pret-investissement');
Route::get('/carte-de-credit', [PageController::class, 'carteCredit'])->name('carte-de-credit');

// Menu Enfant - Hypotheque
Route::get('/programme-dachat-clef-en-main', [PageController::class, 'achatClefEnMain'])->name('programme-dachat-clef-en-main');
Route::get('/pret-hypothecaire', [PageController::class, 'pretHypothecaire'])->name('pret-hypothecaire');

// 3. PAGES DYNAMIQUES (Contrôleurs dédiés)

// Équipe (avec filtre ville)
Route::get('/equipe', [TeamController::class, 'index'])->name('equipe');
Route::get('/conseiller/{slug}', [TeamController::class, 'show'])->name('team.show');

// Événements
Route::get('/evenements', [EventController::class, 'index'])->name('evenements');

// Blog (Liste et Article détail)
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
// Route::get('/article/{id}', [BlogController::class, 'show'])->name('blog.show');
// On demande explicitement à Laravel de lier le paramètre au slug
Route::get('/article/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// 4. CONTACT (Affichage + Envoi)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// 5. AUTHENTIFICATION (Login, Logout, Register AJAX)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register-ajax', [AuthController::class, 'registerAjax'])->name('register.ajax');

// 7. UTILITAIRES & PAGES SECONDAIRES
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/construction', [PageController::class, 'construction'])->name('construction');


Route::get('/partenaires', [PageController::class, 'partenaires'])->name('partenaires');

use App\Livewire\QuoteAutoChat;

// Entrée principale via le code conseiller
Route::get('/consentement/lang/{locale}/{code?}', [ConsentController::class, 'switchLanguage'])
    ->name('consent.language');

Route::get('/consentement/{code?}', [ConsentController::class, 'show'])->name('consent.show');
Route::post('/consentement/accept', [ConsentController::class, 'accept'])->name('consent.accept');

// Accès au Chat (uniquement si has_consented est vrai)
Route::get('/soumission/auto', function () {
    if (!session('has_consented')) {
        return redirect()->to('https://production.vipgpi.ca/equipe');
    }
    return view('quote-auto-page'); // Assurez-vous d'avoir cette vue avec @livewire('quote-auto-chat')
})->name('quote.auto');

Route::get('/soumission/merci', function () {
    session()->forget(['current_submission_id', 'has_consented']);
    return view('quote.success');
})->name('quote.success');

Route::get('/carrieres', [PageController::class, 'carrieres'])->name('carrieres');
