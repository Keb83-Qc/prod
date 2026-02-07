<?php

namespace App\Filament\Resources\HomepageStatResource\Pages;

use App\Filament\Resources\HomepageStatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomepageStats extends ListRecords
{
    protected static string $resource = HomepageStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
