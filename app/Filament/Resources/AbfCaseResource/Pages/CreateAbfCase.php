<?php

namespace App\Filament\Resources\AbfCaseResource\Pages;

use App\Filament\Resources\AbfCaseResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\MaxWidth;

class CreateAbfCase extends CreateRecord
{
    protected static string $resource = AbfCaseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['advisor_user_id'] = auth()->id();
        $data['advisor_code'] = auth()->user()->advisor_code;

        return $data;
    }

    public function getExtraBodyAttributes(): array
    {
        $attributes = parent::getExtraBodyAttributes();
        $attributes['class'] = trim(($attributes['class'] ?? '') . ' abf-fullwidth');
        return $attributes;
    }

    public function getMaxContentWidth(): MaxWidth|string|null
    {
        return MaxWidth::Full;
    }
}
