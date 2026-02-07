<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()->label('Envoyer');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()->hidden();
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()->label('Fermer');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Message envoyé avec succès !';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['sender_id'] = Filament::auth()->id();
        $data['is_read'] = false;
        $data['status'] = $data['status'] ?? 'pending';

        return $data;
    }
}
