<?php

namespace App\Filament\Resources\AbfCaseResource\Pages;

use App\Filament\Resources\AbfCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAbfCase extends EditRecord
{
    protected static string $resource = AbfCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['advisor_user_id'] = auth()->id();
        $data['advisor_code'] = auth()->user()->advisor_code;

        return $data;
    }
}
