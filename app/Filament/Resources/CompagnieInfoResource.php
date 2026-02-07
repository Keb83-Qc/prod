<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompagnieInfoResource\Pages;
use App\Filament\Resources\CompagnieInfoResource\RelationManagers;
use App\Models\CompagnieInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompagnieInfoResource extends Resource
{
    protected static ?string $model = CompagnieInfo::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Compagnies & Types';

    public static function getNavigationGroup(): ?string
    {
        return 'Configuration';
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations Compagnie')
                    ->schema([
                        Forms\Components\TextInput::make('nom_compagnie')
                            ->label('Nom de la compagnie')
                            ->required()
                            ->columnSpanFull(),

                        // --- NOTES BILINGUES ---
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Textarea::make('note_speciale.fr')
                                ->label('Note Spéciale (Français)')
                                ->rows(3),
                            Forms\Components\Textarea::make('note_speciale.en')
                                ->label('Note Spéciale (Anglais)')
                                ->rows(3),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom_compagnie')
                    ->label('Compagnie')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),

                // --- AFFICHAGE DE LA NOTE FR ---
                Tables\Columns\TextColumn::make('note_speciale.fr')
                    ->label('Note (FR)')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('types_count')
                    ->counts('types')
                    ->label('Nb. Types')
                    ->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TypesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompagnieInfos::route('/'),
            'create' => Pages\CreateCompagnieInfo::route('/create'),
            'edit' => Pages\EditCompagnieInfo::route('/{record}/edit'),
        ];
    }
}
