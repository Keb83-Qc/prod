<?php

namespace App\Filament\Resources\GoogleReviewResource\Pages;

use App\Filament\Resources\GoogleReviewResource;
use App\Services\GoogleReviewService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

class ListGoogleReviews extends ListRecords
{
    protected static string $resource = GoogleReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Le bouton de synchronisation
            Actions\Action::make('sync_google')
                ->label('Synchroniser Google')
                ->icon('heroicon-o-arrow-path') // Icône de rafraîchissement
                ->color('primary')
                ->action(function (GoogleReviewService $service) {
                    try {
                        // On appelle votre Service d'importation
                        $service->fetchAndStoreReviews();

                        // Notification de succès
                        Notification::make()
                            ->title('Avis synchronisés avec succès !')
                            ->success()
                            ->send();

                        // On rafraîchit la page pour voir les nouveaux avis
                        return redirect(request()->header('Referer'));
                    } catch (\Exception $e) {
                        // Notification d'erreur
                        Notification::make()
                            ->title('Erreur de synchronisation')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
