<?php

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSlide extends CreateRecord
{
    // 1. Indispensable pour la création aussi

    protected static string $resource = SlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 2. Sélecteur de langue
        ];
    }
}
