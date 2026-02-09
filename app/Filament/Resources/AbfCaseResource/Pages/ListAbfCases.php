<?php

namespace App\Filament\Resources\AbfCaseResource\Pages;

use App\Filament\Resources\AbfCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAbfCases extends ListRecords
{
    protected static string $resource = AbfCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nouveau dossier ABF'),
        ];
    }
}
