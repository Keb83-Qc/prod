<?php

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSlide extends EditRecord
{
    // 1. Cette ligne est indispensable pour que le formulaire comprenne le JSON

    protected static string $resource = SlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 2. On ajoute le sélecteur de langue en haut de la page
            Actions\DeleteAction::make(),
        ];
    }
}
