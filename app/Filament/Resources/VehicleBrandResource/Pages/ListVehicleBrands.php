<?php

namespace App\Filament\Resources\VehicleBrandResource\Pages;

use App\Filament\Resources\VehicleBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;

class ListVehicleBrands extends ListRecords
{
    protected static string $resource = VehicleBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            // --- ACTION 1 : CRÉER LES MARQUES POPULAIRES (LISTE PROPRE) ---
            Actions\Action::make('import_popular_makes')
                ->label('Importer Marques (Liste Canada/USA)')
                ->icon('heroicon-o-check-badge')
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Réinitialiser avec les marques populaires ?')
                ->modalDescription('Cela va créer les marques courantes (Honda, Ford, Tesla...) et ignorer les camions lourds et remorques.')
                ->action(function () {
                    $count = 0;

                    // Liste curée des marques "Grand Public" au Canada
                    $brands = [
                        // Asiatiques
                        'Acura',
                        'Honda',
                        'Toyota',
                        'Lexus',
                        'Nissan',
                        'Infiniti',
                        'Mazda',
                        'Subaru',
                        'Mitsubishi',
                        'Hyundai',
                        'Kia',
                        'Genesis',
                        'Suzuki',
                        'Scion',

                        // Américaines
                        'Ford',
                        'Lincoln',
                        'Chevrolet',
                        'GMC',
                        'Buick',
                        'Cadillac',
                        'Dodge',
                        'Chrysler',
                        'Jeep',
                        'Ram',
                        'Tesla',
                        'Rivian',
                        'Lucid',
                        'Hummer',
                        'Pontiac',
                        'Saturn',
                        'Oldsmobile',
                        'Mercury',

                        // Européennes
                        'Audi',
                        'BMW',
                        'Mercedes-Benz',
                        'Volkswagen',
                        'Volvo',
                        'Porsche',
                        'Land Rover',
                        'Jaguar',
                        'Mini',
                        'Fiat',
                        'Alfa Romeo',
                        'Maserati',
                        'Bentley',
                        'Rolls-Royce',
                        'Ferrari',
                        'Lamborghini',
                        'Aston Martin',
                        'McLaren',
                        'Polestar',
                        'Smart',
                        'Saab'
                    ];

                    foreach ($brands as $name) {
                        $brand = \App\Models\VehicleBrand::firstOrCreate([
                            'name' => $name
                        ]);

                        if ($brand->wasRecentlyCreated) {
                            $count++;
                        }
                    }

                    \Filament\Notifications\Notification::make()
                        ->title('Liste propre importée')
                        ->body("$count nouvelles marques ajoutées.")
                        ->success()
                        ->send();
                }),

            // --- ACTION 2 : TÉLÉCHARGER LES MODÈLES (UNIQUEMENT POUR VOS MARQUES) ---
            Actions\Action::make('sync_models')
                ->label('Télécharger les Modèles')
                ->icon('heroicon-o-cloud-arrow-down')
                ->color('success')
                ->form([
                    \Filament\Forms\Components\Select::make('year')
                        ->label('Année à importer')
                        ->options(array_combine(range(date('Y') + 1, 2000), range(date('Y') + 1, 2000)))
                        ->default(date('Y'))
                        ->required(),
                ])
                ->action(function (array $data) {
                    set_time_limit(600); // 10 minutes
                    $client = new \GuzzleHttp\Client();

                    // On ne prend QUE les marques qui existent dans VOTRE base de données (donc la liste propre)
                    $brands = \App\Models\VehicleBrand::all();
                    $year = $data['year'];
                    $countCreated = 0;

                    foreach ($brands as $brand) {
                        try {
                            // On demande à l'API : "Donne-moi les modèles pour CETTE marque précise et CETTE année"
                            $url = "https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/" . rawurlencode($brand->name) . "/modelyear/{$year}?format=json";

                            $response = $client->get($url);
                            $results = json_decode($response->getBody(), true)['Results'] ?? [];

                            foreach ($results as $item) {
                                $modelName = trim($item['Model_Name']);

                                // Filtre basique pour éviter certains doublons bizarres de l'API
                                if (empty($modelName)) continue;

                                $model = \App\Models\VehicleModel::firstOrCreate(
                                    [
                                        'vehicle_brand_id' => $brand->id,
                                        'name' => $modelName
                                    ]
                                );

                                if ($model->wasRecentlyCreated) {
                                    $countCreated++;
                                }
                            }
                        } catch (\Exception $e) {
                            continue;
                        }
                    }

                    \Filament\Notifications\Notification::make()
                        ->title("Modèles $year importés")
                        ->body("$countCreated modèles ajoutés pour vos marques.")
                        ->success()
                        ->send();
                }),
            // --- ACTION 3 : RÉSERVÉE SUPER ADMIN - IMPORTATION MASSIVE SÉQUENTIELLE ---
            Actions\Action::make('import_full_history')
                ->label('Tout importer')
                ->icon('heroicon-o-server-stack')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Lancer l\'importation en arrière-plan ?')
                ->modalDescription('Le processus va démarrer sur le serveur. Vous pouvez continuer à travailler. Une notification vous avertira quand ce sera terminé (env. 10-15 min).')
                ->visible(fn() => auth()->id() === 1)
                ->action(function () {

                    // On lance le Job en passant l'utilisateur actuel
                    \App\Jobs\ImportNhtsaModels::dispatch(auth()->user());

                    \Filament\Notifications\Notification::make()
                        ->title('Tâche lancée !')
                        ->body('L\'importation tourne en fond. Vous recevrez une alerte à la fin.')
                        ->info()
                        ->send();
                }),
        ];
    }
}
