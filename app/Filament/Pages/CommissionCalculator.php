<?php

namespace App\Filament\Pages;

use App\Models\CompagnieInfo;
use App\Models\TauxCommission;
use Filament\Pages\Page;

class CommissionCalculator extends Page
{
    // Configuration du Menu
    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationLabel = 'Calculateur de Prime';

    public static function getNavigationGroup(): ?string
    {
        return 'Espace Conseiller';
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    protected static string $view = 'filament.pages.premium-calculator';

    // --- VARIABLES PUBLIQUES ---
    public $amount = 100000;
    public $company = '';
    public $type_placement = '';

    // Données pour les listes
    public $companiesOptions = [];
    public $typesOptions = [];

    // Résultats
    public $results = [];
    public $specialNote = null;

    public function mount(): void
    {
        // Charger la liste des compagnies au chargement de la page
        $this->companiesOptions = CompagnieInfo::orderBy('nom_compagnie')
            ->pluck('nom_compagnie', 'nom_compagnie')
            ->toArray();
    }

    // --- HOOKS LIVEWIRE (Se lancent automatiquement quand une valeur change) ---

    public function updatedCompany($value)
    {
        // 1. Reset
        $this->type_placement = '';
        $this->results = [];

        // 2. Charger la note spéciale
        $compagnieData = CompagnieInfo::where('nom_compagnie', $value)->first();

        if ($compagnieData) {
            // RÉCUPÉRATION BILINGUE :
            // On récupère la note. Si c'est un tableau, on prend la clé 'fr'.
            $note = $compagnieData->note_speciale;

            if (is_array($note)) {
                $this->specialNote = $note[app()->getLocale()] ?? ($note['fr'] ?? '');
            } else {
                $this->specialNote = $note;
            }

            // 3. Charger les types associés
            $this->typesOptions = $compagnieData->types()->pluck('nom_type', 'nom_type')->toArray();
        } else {
            $this->specialNote = null;
            $this->typesOptions = [];
        }
    }

    // Quand le type change, on calcule
    public function updatedTypePlacement()
    {
        $this->calculate();
    }

    // Quand le montant change (avec un délai pour ne pas spammer), on calcule
    public function updatedAmount()
    {
        if (!empty($this->company) && !empty($this->type_placement)) {
            $this->calculate();
        }
    }

    public function calculate()
    {
        // Validation simple
        if (empty($this->amount) || empty($this->company) || empty($this->type_placement)) {
            $this->results = [];
            return;
        }

        // Recherche des taux (Recherche souple 'LIKE' pour éviter les erreurs d'espaces)
        $tauxOptions = TauxCommission::query()
            ->where('company', 'LIKE', trim($this->company))
            ->where('type_placement', 'LIKE', trim($this->type_placement))
            ->get();

        $calculatedResults = [];

        foreach ($tauxOptions as $option) {
            $tMensuel = (float) $option->taux_mensuel;
            $tInitial = (float) $option->taux_initial;
            $montant = (float) $this->amount;

            // Formule de calcul
            $commMensuelle = ($montant * (($tMensuel / 100) * 0.8)) / 12;
            $commInitiale = $montant * ($tInitial / 100) * 0.8;

            $calculatedResults[] = [
                'option' => $option->option_nom,
                'taux_mensuel' => $tMensuel,
                'taux_initial' => $tInitial,
                'comm_mensuelle' => $commMensuelle,
                'comm_initiale' => $commInitiale,
            ];
        }

        $this->results = $calculatedResults;
    }

    /**
     * QUI PEUT VOIR CETTE PAGE ?
     */
    public static function canAccess(): bool
    {
        // On récupère l'utilisateur connecté
        $user = auth()->user();

        // Tout le monde peut voir le calculateur
        return true;
    }
}
