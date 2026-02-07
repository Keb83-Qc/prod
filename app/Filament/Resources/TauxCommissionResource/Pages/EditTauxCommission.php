<?php

namespace App\Filament\Resources\TauxCommissionResource\Pages;

use App\Filament\Resources\TauxCommissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTauxCommission extends EditRecord
{
    protected static string $resource = TauxCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
