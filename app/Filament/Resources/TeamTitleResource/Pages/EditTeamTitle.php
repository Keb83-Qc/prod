<?php

namespace App\Filament\Resources\TeamTitleResource\Pages;

use App\Filament\Resources\TeamTitleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeamTitle extends EditRecord
{

    protected static string $resource = TeamTitleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
