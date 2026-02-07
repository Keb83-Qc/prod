<?php

namespace App\Filament\Resources\VehicleModelResource\Pages;

use App\Filament\Resources\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB; // Important pour la rapidité
use Filament\Notifications\Notification;

class ListVehicleModels extends ListRecords
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            // --- BOUTON SUPER ADMIN : TOUT SUPPRIMER ---
            Actions\Action::make('truncate_all')
                ->label('SUPER ADMIN : Vider la table (Reset)')
                ->icon('heroicon-o-trash')
                ->color('danger') // Rouge pour le danger

                // Visible uniquement pour l'ID 1 (Vous)
                ->visible(fn() => auth()->id() === 1)

                ->requiresConfirmation()
                ->modalHeading('Êtes-vous absolument sûr ?')
                ->modalDescription('Ceci va supprimer TOUS les modèles de véhicules de la base de données. Cette action est irréversible et réinitialisera les IDs.')
                ->modalSubmitActionLabel('Oui, tout supprimer')

                ->action(function () {
                    try {
                        // On désactive temporairement la sécurité des clés étrangères pour forcer le nettoyage
                        // Utile si des soumissions sont liées à des modèles qui n'existent plus
                        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

                        VehicleModel::truncate(); // Supprime tout et remet le compteur ID à 0

                        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                        Notification::make()
                            ->title('Table vidée avec succès')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        // En cas d'erreur, on réactive la sécurité
                        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                        Notification::make()
                            ->title('Erreur lors de la suppression')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
