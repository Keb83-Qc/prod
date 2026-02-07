<?php

namespace App\Filament\Resources\TeamTitleResource\Pages;

use App\Filament\Resources\TeamTitleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeamTitles extends ListRecords
{

    protected static string $resource = TeamTitleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
