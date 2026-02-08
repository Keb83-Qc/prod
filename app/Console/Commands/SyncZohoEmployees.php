<?php

namespace App\Console\Commands;

use App\Services\ZohoService;
use Illuminate\Console\Command;

class SyncZohoEmployees extends Command
{
    // Le nom de la commande à taper dans le terminal
    protected $signature = 'zoho:sync';

    protected $description = 'Synchronise les employés depuis Zoho People vers la table employees.';

    public function handle(ZohoService $service)
    {
        $this->info('🚀 Démarrage de la synchronisation Zoho People...');

        try {
            // On appelle la méthode de synchro du service
            $count = $service->syncUsers();

            $this->newLine();
            $this->info("✅ Succès ! {$count} employés ont été synchronisés.");

            return self::SUCCESS;
        } catch (\Throwable $exception) {
            $this->newLine();
            $this->error('❌ Erreur lors de la synchronisation :');
            $this->error($exception->getMessage());

            return self::FAILURE;
        }
    }
}
