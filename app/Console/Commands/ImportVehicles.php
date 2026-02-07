<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Http;

class ImportVehicles extends Command
{
    protected $signature = 'vehicles:sync';
    protected $description = 'Importe les modèles pour une liste spécifique de marques canadiennes';

    public function handle()
    {
        // Votre liste exacte
        $selectedMakes = [
            'Ford',
            'Toyota',
            'Chevrolet',
            'Hyundai',
            'Honda',
            'GMC',
            'Nissan',
            'Ram',
            'Kia',
            'Volkswagen',
            'Mazda',
            'Jeep',
            'Subaru',
            'BMW',
            'Mercedes-Benz',
            'Audi',
            'Lexus',
            'Volvo',
            'Cadillac',
            'Buick',
            'Chrysler',
            'Dodge',
            'Mini',
            'Porsche',
            'Jaguar',
            'Land Rover',
            'Tesla',
            'Infiniti',
            'Acura',
            'Genesis',
            'Mitsubishi',
            'Lincoln',
            'Alfa Romeo',
            'Fiat'
        ];

        $vehicleTypes = ['Passenger Car', 'Truck', 'Multipurpose Passenger Vehicle (MPV)'];

        $this->info("Début de l'importation pour " . count($selectedMakes) . " marques...");

        foreach ($selectedMakes as $makeName) {
            $this->warn("\nTraitement de : $makeName");

            // Création de la marque
            $brand = VehicleBrand::firstOrCreate(['name' => $makeName]);

            foreach ($vehicleTypes as $type) {
                // Encodage du type pour l'URL
                $encodedType = str_replace(' ', '%20', $type);
                $url = "https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeYear/make/" . str_replace(' ', '%20', $makeName) . "/vehicleType/{$encodedType}?format=json";

                try {
                    $response = Http::timeout(30)->get($url);

                    if ($response->successful()) {
                        $models = $response->json()['Results'];
                        $count = 0;

                        foreach ($models as $modelData) {
                            $modelName = trim($modelData['Model_Name']);

                            // On évite les noms de modèles génériques ou vides
                            if (!empty($modelName)) {
                                VehicleModel::firstOrCreate([
                                    'vehicle_brand_id' => $brand->id,
                                    'name' => $modelName
                                ]);
                                $count++;
                            }
                        }
                        if ($count > 0) {
                            $this->info("  - $count modèles ajoutés pour le type : $type");
                        }
                    }
                } catch (\Exception $e) {
                    $this->error("  - Erreur pour $makeName ($type) : " . $e->getMessage());
                }
            }
        }

        $this->info("\nImportation terminée !");
    }
}
