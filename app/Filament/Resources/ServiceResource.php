<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Services';

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
                Forms\Components\Grid::make(3)
                    ->schema([
                        // COLONNE GAUCHE (Traductions)
                        Forms\Components\Group::make()->columnSpan(2)->schema([
                            Tabs::make('Traductions')
                                ->tabs([
                                    Tabs\Tab::make('Français')->icon('heroicon-m-language')
                                        ->schema([
                                            Forms\Components\TextInput::make('title_fr')->label('Titre (FR)')->required(),
                                            Forms\Components\Textarea::make('description_fr')->label('Description (FR)')->rows(4)->required(),
                                        ]),
                                    Tabs\Tab::make('Anglais')->icon('heroicon-m-globe-alt')
                                        ->schema([
                                            Forms\Components\TextInput::make('title_en')->label('Title (EN)'),
                                            Forms\Components\Textarea::make('description_en')->label('Description (EN)')->rows(4),
                                        ]),
                                ]),
                        ]),

                        // COLONNE DROITE (Infos techniques)
                        Forms\Components\Section::make('Détails')->columnSpan(1)->schema([
                            // Aperçu de l'image actuelle (VITAL pour voir les images 'assets/')
                            Forms\Components\Placeholder::make('apercu')
                                ->label('Image actuelle')
                                ->content(fn($record) => $record && $record->image_url
                                    ? new \Illuminate\Support\HtmlString("<img src='{$record->image_url}' style='width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd;'>")
                                    : 'Aucune image'),

                            // Le champ d'upload modifié
                            Forms\Components\FileUpload::make('image')
                                ->image()
                                ->directory('uploads/services')
                                ->dehydrated(fn($state) => filled($state)) // <--- C'est ça qui empêche la suppression
                                ->label('Remplacer l\'image'),

                            Forms\Components\TextInput::make('link')->label('Lien (ex: pret.php)'),
                            Forms\Components\TextInput::make('sort_order')->label('Ordre')->numeric()->default(0),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('image_url')
                    ->label('Image')
                    ->formatStateUsing(fn($state) => $state ? "<img src='{$state}' style='height: 40px; width: 40px; object-fit: cover; border-radius: 5px;'>" : '')
                    ->html(),
                Tables\Columns\TextColumn::make('title_fr')->label('Titre')->searchable(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make(),])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),]);
    }

    public static function getRelations(): array
    {
        return [];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
