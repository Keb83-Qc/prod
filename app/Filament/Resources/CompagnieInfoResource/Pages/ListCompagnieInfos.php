<?php

namespace App\Filament\Resources\CompagnieInfoResource\Pages;

use App\Filament\Resources\CompagnieInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompagnieInfos extends ListRecords
{
    protected static string $resource = CompagnieInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nouvelle Compagnie'), // Petit bonus : Label en français
        ];
    }
}
