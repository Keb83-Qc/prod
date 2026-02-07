<?php

namespace App\Filament\Resources\TauxCommissionResource\Pages;

use App\Filament\Resources\TauxCommissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTauxCommissions extends ListRecords
{
    protected static string $resource = TauxCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nouveau Taux'),
        ];
    }
}
