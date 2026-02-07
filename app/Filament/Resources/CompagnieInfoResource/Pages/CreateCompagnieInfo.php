<?php

namespace App\Filament\Resources\CompagnieInfoResource\Pages;

use App\Filament\Resources\CompagnieInfoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompagnieInfo extends CreateRecord
{
    protected static string $resource = CompagnieInfoResource::class;

    // Redirection vers la liste après avoir créé, c'est plus fluide
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
