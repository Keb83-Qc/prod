<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Services\ZohoService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('syncZoho')
                ->label('Synchroniser (Zoho People)')
                ->icon('heroicon-o-arrow-path')
                ->color('success')
                ->action(function () {
                    try {
                        $count = app(ZohoService::class)->syncUsers();

                        Notification::make()
                            ->title("Succès : {$count} employés synchronisés.")
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Erreur Zoho')
                            ->body($e->getMessage())
                            ->danger()
                            ->persistent()
                            ->send();
                    }
                }),
        ];
    }
}
