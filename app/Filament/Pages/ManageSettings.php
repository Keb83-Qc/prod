<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Facades\Filament;

class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $settings = GeneralSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Configuration';
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = Filament::auth()->user();

        return $user
            && ($user->hasRoleByName('super_admin') || $user->hasRoleByName('admin'));
    }

    public static function canAccess(): bool
    {
        $user = Filament::auth()->user();

        return $user
            && ($user->hasRoleByName('super_admin') || $user->hasRoleByName('admin'));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Bannière de maintenance')
                    ->schema([
                        Toggle::make('banner_active')->label('Activer la bannière'),
                        TextInput::make('banner_text')->label('Texte'),
                        ColorPicker::make('banner_color')->label('Couleur'),
                    ]),
                Section::make('SEO Global')
                    ->schema([
                        TextInput::make('seo_default_title')->label('Titre par défaut'),
                        TextInput::make('seo_default_desc')->label('Description par défaut'),
                    ]),
            ]);
    }
}
