<?php

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSlides extends ListRecords
{
    // 1. Indispensable pour la liste
    protected static string $resource = SlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 2. Sélecteur de langue
            Actions\CreateAction::make(),
        ];
    }
}
