<?php

namespace App\Filament\Resources\AbfCaseResource\Pages;

use App\Filament\Resources\AbfCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\MaxWidth;

class EditAbfCase extends EditRecord
{
    protected static string $resource = AbfCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Recommandé: ne pas écraser advisor_user_id / advisor_code à l’édition
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
