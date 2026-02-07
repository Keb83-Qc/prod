<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TauxCommissionResource\Pages;
use App\Models\TauxCommission;
use App\Models\CompagnieInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TauxCommissionResource extends Resource
{
    protected static ?string $model = TauxCommission::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Taux de Commission';

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
                Forms\Components\Section::make('Détails du Taux')
                    ->schema([
                        // 1. Sélection de la Compagnie
                        Forms\Components\Select::make('company')
                            ->label('Compagnie')
                            ->options(CompagnieInfo::pluck('nom_compagnie', 'nom_compagnie'))
                            ->required()
                            ->live() // Rend le champ réactif
                            ->afterStateUpdated(fn(Forms\Set $set) => $set('type_placement', null)),

                        // 2. Sélection du Type (Dépendant de la compagnie)
                        Forms\Components\Select::make('type_placement')
                            ->label('Type de placement')
                            ->options(function (Forms\Get $get) {
                                $companyName = $get('company');
                                if (!$companyName) return [];

                                // On cherche l'ID de la compagnie grâce à son nom
                                $compagnie = CompagnieInfo::where('nom_compagnie', $companyName)->first();
                                if (!$compagnie) return [];

                                // On retourne les types associés
                                return $compagnie->types()->pluck('nom_type', 'nom_type');
                            })
                            ->required()
                            ->disabled(fn(Forms\Get $get) => !$get('company')),

                        Forms\Components\TextInput::make('option_nom')
                            ->label('Option (ex: 5 ans)')
                            ->required(),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('taux_mensuel')
                                ->label('Taux Mensuel (%)')
                                ->numeric()
                                ->step(0.01)
                                ->suffix('%')
                                ->required(),

                            Forms\Components\TextInput::make('taux_initial')
                                ->label('Taux Initial (%)')
                                ->numeric()
                                ->step(0.01)
                                ->suffix('%')
                                ->required(),
                        ]),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company')
                    ->label('Compagnie')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('type_placement')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('option_nom')
                    ->label('Option')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('taux_mensuel')
                    ->label('Mensuel')
                    ->suffix('%')
                    ->color('primary'),

                Tables\Columns\TextColumn::make('taux_initial')
                    ->label('Initial')
                    ->suffix('%')
                    ->color('success'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('company')
                    ->options(CompagnieInfo::pluck('nom_compagnie', 'nom_compagnie'))
                    ->label('Filtrer par Compagnie'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTauxCommissions::route('/'),
            'create' => Pages\CreateTauxCommission::route('/create'),
            'edit' => Pages\EditTauxCommission::route('/{record}/edit'),
        ];
    }
}
