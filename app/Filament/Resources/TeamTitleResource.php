<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamTitleResource\Pages;
use App\Models\TeamTitle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class TeamTitleResource extends Resource
{
    protected static ?string $model = TeamTitle::class;

    // ... icône et groupe ...
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'Titres de poste';

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion Conseillers';
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Noms du titre de poste')
                    ->description('Saisissez le titre dans les deux langues sur la même page.')
                    ->schema([
                        Forms\Components\TextInput::make('name.fr')
                            ->label('Titre (Français)')
                            ->required()
                            ->placeholder('Ex: Directeur'),

                        Forms\Components\TextInput::make('name.en')
                            ->label('Titre (Anglais)')
                            ->required()
                            ->placeholder('Ex: Director'),
                    ])->columns(2), // Affiche les deux champs côte à côte
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name.fr')
                    ->label('Titre (FR)')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name.en')
                    ->label('Titre (EN)')
                    ->sortable()
                    ->searchable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamTitles::route('/'),
            'create' => Pages\CreateTeamTitle::route('/create'),
            'edit' => Pages\EditTeamTitle::route('/{record}/edit'),
        ];
    }
}
