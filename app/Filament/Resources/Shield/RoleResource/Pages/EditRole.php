<?php

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use BezhanSalleh\FilamentShield\Resources\RoleResource\Pages\EditRole as BaseEditRole;
use Filament\Actions;

class EditRole extends BaseEditRole
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Fermer')
                ->icon('heroicon-o-x-mark')
                ->url(static::getResource()::getUrl('index')),

            Actions\Action::make('save')
                ->label('Sauvegarder')
                ->icon('heroicon-o-check')
                ->action('saveAndBack')     // 👈 notre méthode ci-dessous
                ->keyBindings(['mod+s'])
                ->color('primary'),
        ];
    }

    protected function getFormActions(): array
    {
        return []; // ✅ enlève les boutons du bas
    }

    public function saveAndBack(): void
    {
        $this->save(); // méthode Filament existante
        $this->redirect(static::getResource()::getUrl('index')); // ✅ retour liste rôles
    }
}
