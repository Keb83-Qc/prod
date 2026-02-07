<?php

namespace App\Filament\Resources\TauxCommissionResource\Pages;

use App\Filament\Resources\TauxCommissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTauxCommission extends CreateRecord
{
    protected static string $resource = TauxCommissionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
