<?php

namespace App\Filament\Resources\CareerPageResource\Pages;

use App\Filament\Resources\CareerPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareerPage extends EditRecord
{
    protected static string $resource = CareerPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
