<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Titre dans le menu
    protected static ?string $navigationLabel = 'Partenaires';

    public static function getNavigationGroup(): ?string
    {
        return 'Marketing'; // Doit correspondre exactement à la clé dans le fichier config
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // SECTION 1 : INFOS DE BASE
                Forms\Components\Section::make('Informations')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom du partenaire')
                            ->required()
                            ->columnSpanFull(), // Prend toute la largeur

                        Forms\Components\TextInput::make('website')
                            ->label('Site Web (URL)')
                            ->url()
                            ->suffixIcon('heroicon-m-globe-alt')
                            ->columnSpanFull(),
                    ]),

                // SECTION 2 : LOGOS (BILINGUE)
                Forms\Components\Section::make('Logos')
                    ->description('Gérez les logos pour les versions française et anglaise.')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([

                            // 1. Logo FR (Principal)
                            // On remplace 'logo' par 'logo_fr'
                            Forms\Components\FileUpload::make('logo_fr')
                                ->label('Logo (Français / Défaut)')
                                ->image()
                                ->directory('partners')
                                ->imageEditor() // Permet de recadrer si besoin
                                ->required(), // Obligatoire car c'est la base

                            // 2. Logo EN (Optionnel)
                            Forms\Components\FileUpload::make('logo_en')
                                ->label('Logo (Anglais)')
                                ->helperText('Laisser vide pour utiliser le logo français partout.')
                                ->image()
                                ->directory('partners')
                                ->imageEditor(),
                        ]),
                    ]),

                // SECTION 3 : AFFICHAGE
                Forms\Components\Section::make('Paramètres')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Toggle::make('is_visible')
                                ->label('Visible sur le site')
                                ->default(true),

                            Forms\Components\TextInput::make('sort_order')
                                ->label('Ordre d\'affichage')
                                ->numeric()
                                ->default(function () {
                                    return (Partner::max('sort_order') ?? 0) + 1;
                                })
                                ->required(),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // On affiche le logo FR dans la liste
                Tables\Columns\ImageColumn::make('logo_fr')
                    ->label('Logo'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                // Petite colonne icône pour voir rapidement si un logo EN existe
                Tables\Columns\IconColumn::make('logo_en')
                    ->label('Logo EN ?')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-minus')
                    ->getStateUsing(fn($record) => !empty($record->logo_en)),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Visible'),

                // Ajout de la colonne ordre pour trier visuellement
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
