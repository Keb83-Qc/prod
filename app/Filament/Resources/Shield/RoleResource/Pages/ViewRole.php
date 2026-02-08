<?php

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use BezhanSalleh\FilamentShield\Resources\RoleResource\Pages\ViewRole as BaseViewRole;
use Filament\Actions;

class ViewRole extends BaseViewRole
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(), // bouton en haut (va vers /edit)
        ];
    }
}
