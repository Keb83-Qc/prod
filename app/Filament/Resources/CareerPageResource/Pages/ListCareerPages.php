<?php

namespace App\Filament\Resources\CareerPageResource\Pages;

use App\Filament\Resources\CareerPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareerPages extends ListRecords
{
    protected static string $resource = CareerPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
