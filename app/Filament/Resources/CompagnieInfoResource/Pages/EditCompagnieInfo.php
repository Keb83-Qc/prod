<?php

namespace App\Filament\Resources\CompagnieInfoResource\Pages;

use App\Filament\Resources\CompagnieInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompagnieInfo extends EditRecord
{
    protected static string $resource = CompagnieInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(), // Permet de supprimer la compagnie
        ];
    }
}
