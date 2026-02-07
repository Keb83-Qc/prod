<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoogleReviewService;

class FetchGoogleReviews extends Command
{
    // Le nom de la commande à taper dans le terminal
    protected $signature = 'google:fetch-reviews';

    protected $description = 'Récupère les avis depuis Google Places API';

    public function handle(GoogleReviewService $service)
    {
        $this->info('Connexion à Google en cours...');

        try {
            $service->fetchAndStoreReviews();
            $this->info('Avis importés avec succès !');
        } catch (\Exception $e) {
            $this->error('Erreur : ' . $e->getMessage());
        }
    }
}
