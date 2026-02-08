<?php

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use BezhanSalleh\FilamentShield\Resources\RoleResource\Pages\CreateRole as BaseCreateRole;
use Filament\Actions;

class CreateRole extends BaseCreateRole
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Fermer')
                ->icon('heroicon-o-x-mark')
                ->url(static::getResource()::getUrl('index')),

            Actions\Action::make('create')
                ->label('Créer')
                ->icon('heroicon-o-check')
                ->action('createAndBack')
                ->keyBindings(['mod+s'])
                ->color('primary'),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }

    public function createAndBack(): void
    {
        $this->create();
        $this->redirect(static::getResource()::getUrl('index'));
    }
}
