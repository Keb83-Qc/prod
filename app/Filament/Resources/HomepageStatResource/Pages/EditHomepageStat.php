<?php

namespace App\Filament\Resources\HomepageStatResource\Pages;

use App\Filament\Resources\HomepageStatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomepageStat extends EditRecord
{
    protected static string $resource = HomepageStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
