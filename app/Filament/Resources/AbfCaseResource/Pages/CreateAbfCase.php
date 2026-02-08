<?php

namespace App\Filament\Resources\AbfCaseResource\Pages;

use App\Filament\Resources\AbfCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAbfCase extends CreateRecord
{
    protected static string $resource = AbfCaseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['advisor_user_id'] = auth()->id();
        $data['advisor_code'] = auth()->user()->advisor_code;

        return $data;
    }
}
