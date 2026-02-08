<?php

namespace App\Filament\Resources\Shield;

use BezhanSalleh\FilamentShield\Resources\RoleResource as BaseRoleResource;
use App\Filament\Resources\Shield\RoleResource\Pages;

class RoleResource extends BaseRoleResource
{
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view'   => Pages\ViewRole::route('/{record}'),          // ✅ AJOUT
            'edit'   => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
