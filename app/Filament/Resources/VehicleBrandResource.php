<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleBrandResource\Pages;
use App\Models\VehicleBrand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\VehicleBrandResource\RelationManagers\ModelsRelationManager;

class VehicleBrandResource extends Resource
{
    protected static ?string $model = VehicleBrand::class;
    protected static bool $shouldRegisterNavigation = true;

    // Icône qui apparaîtra dans la barre latérale
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Marques de Véhicules';
    protected static ?string $modelLabel = 'Marque';

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
                Forms\Components\Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom de la marque')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Toggle::make('is_active')
                            ->label('Afficher dans le chat de soumission')
                            ->default(true)
                            ->helperText('Si désactivé, cette marque et ses modèles ne seront plus visibles par les clients.'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),

                // ToggleColumn permet d'activer/désactiver sans entrer dans la fiche
                ToggleColumn::make('is_active')
                    ->label('Activé'),

                Tables\Columns\TextColumn::make('models_count')
                    ->label('Nombre de modèles')
                    ->counts('models'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Statut')
                    ->options([
                        '1' => 'Activées',
                        '0' => 'Désactivées',
                    ])
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
            'index' => Pages\ListVehicleBrands::route('/'),
            'create' => Pages\CreateVehicleBrand::route('/create'),
            'edit' => Pages\EditVehicleBrand::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            ModelsRelationManager::class,
        ];
    }
}
