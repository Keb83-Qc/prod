<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class ImportNhtsaModels implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3600; // 1 heure max (pour être sûr)
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        set_time_limit(0);
        ini_set('memory_limit', '1024M'); // Plus de mémoire

        $client = new Client();
        $brands = VehicleBrand::all(); // On ne traite que VOS marques propres

        // On commence par les années récentes (plus pertinent) vers les anciennes
        $years = range(date('Y') + 1, 2000);
        $totalCreated = 0;

        foreach ($brands as $brand) {
            foreach ($years as $year) {
                try {
                    // API NHTSA
                    $url = "https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/" . rawurlencode($brand->name) . "/modelyear/{$year}?format=json";
                    $response = $client->get($url);
                    $results = json_decode($response->getBody(), true)['Results'] ?? [];

                    foreach ($results as $item) {
                        $modelName = trim($item['Model_Name']);

                        // --- LE FILTRE ULTRA AGRESSIF ---
                        if ($this->isUninsurableModel($modelName)) {
                            continue; // On saute ce modèle, c'est une poubelle
                        }

                        // Création
                        $model = VehicleModel::firstOrCreate(
                            [
                                'vehicle_brand_id' => $brand->id,
                                'name' => $modelName
                            ]
                        );

                        if ($model->wasRecentlyCreated) {
                            $totalCreated++;
                        }
                    }

                    // Pause légère pour l'API
                    usleep(100000);
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        Notification::make()
            ->title('Nettoyage et Importation terminés')
            ->body("Le filtre a bloqué les véhicules commerciaux. $totalCreated modèles pertinents ajoutés.")
            ->success()
            ->sendToDatabase($this->user);
    }

    /**
     * Cette fonction détermine si un modèle est "assurable" pour un particulier
     */
    private function isUninsurableModel($name): bool
    {
        if (empty($name)) return true;

        // 1. Convertir en majuscules pour la comparaison
        $upperName = strtoupper($name);

        // 2. Liste noire stricte (Mots clés commerciaux/incomplets)
        $blacklist = [
            'INCOMPLETE',
            'CHASSIS',
            'STRIPPED',
            'CUTAWAY',
            'CAB',
            'COMMERCIAL',
            'STEP VAN',
            'FORWARD CONTROL',
            'GLIDER',
            'POLICE',
            'AMBULANCE',
            'HEARSE',
            'LIMOUSINE',
            'LIMO',
            'SCHOOL BUS',
            'SHUTTLE',
            'TRANSIT BUS',
            'COACH',
            'POSTAL',
            'DELIVERY',
            'TRACTOR',
            'TRAILER',
            'DOLLY',
            'LOW SPEED',
            'NEIGHBORHOOD',
            'GOLF',
            'SWEEPER',
            'ARMORED',
            'MILITARY',
            'UTILITY',
            'CARGO VAN'
        ];

        foreach ($blacklist as $badWord) {
            if (str_contains($upperName, $badWord)) {
                return true; // Rejeté
            }
        }

        // 3. Rejet des Camions Lourds (Heavy Duty)
        // Ex: F-450, F-550, F-650, F-750 (Ford)
        if (preg_match('/F-[4-9][0-9][0-9]/', $upperName)) return true;

        // Ex: 4500, 5500, 6500 (Ram, GM)
        if (preg_match('/(4500|5500|6500|7500|8500)/', $upperName)) return true;

        // Ex: International, Freightliner series (souvent des chiffres seuls ou codes bizarres)
        // Si le nom contient "CLASS" suivi d'un chiffre (Class 4, Class 8)
        if (str_contains($upperName, 'CLASS')) return true;

        return false; // C'est un modèle "assurable" (Passenger/Light Truck)
    }
}
