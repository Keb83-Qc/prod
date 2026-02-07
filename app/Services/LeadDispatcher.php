<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LeadDispatcher
{
    public function assignAdvisor()
    {
        return DB::transaction(function () {
            // 1. Trouver les conseillers éligibles (Actifs)
            $candidates = User::where('accepts_leads', true)->get();

            if ($candidates->isEmpty()) {
                // Fallback : Si personne n'est actif, on retourne un admin ou null
                return User::where('email', 'admin@vipgpi.ca')->first();
            }

            // 2. Filtrer ceux qui n'ont pas encore rempli leur quota pour ce cycle
            // Ex: Si le poids est 2 et qu'il a reçu 1, il est éligible.
            $eligible = $candidates->filter(function ($user) {
                return $user->leads_received_cycle < $user->lead_weight;
            });

            // 3. FIN DU CYCLE : Si tout le monde a atteint son quota
            if ($eligible->isEmpty()) {
                // On remet tout le monde à 0
                User::where('accepts_leads', true)->update(['leads_received_cycle' => 0]);

                // On ré-exécute la logique (récursion) pour choisir le premier du nouveau cycle
                return $this->assignAdvisor();
            }

            // 4. CHOIX DU GAGNANT
            // Parmi les éligibles, on prend celui qui attend depuis le plus longtemps
            // (celui dont last_lead_received_at est le plus vieux ou null)
            $winner = $eligible->sortBy('last_lead_received_at')->first();

            // 5. MISE À JOUR
            $winner->increment('leads_received_cycle');
            $winner->update(['last_lead_received_at' => now()]);

            Log::info("Lead auto assigné à : {$winner->first_name} (Cycle: {$winner->leads_received_cycle}/{$winner->lead_weight})");

            return $winner;
        });
    }
}
