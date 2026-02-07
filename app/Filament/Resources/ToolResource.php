<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ToolResource\Pages;
use App\Models\Tool;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class ToolResource extends Resource
{
    protected static ?string $model = Tool::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Gestion des Outils';

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
                Forms\Components\Section::make('Détails de l\'outil')
                    ->schema([
                        // Titres bilingues
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('title.fr')
                                ->label('Titre (Français)')
                                ->required(),
                            Forms\Components\TextInput::make('title.en')
                                ->label('Titre (Anglais)')
                                ->required(),
                        ]),

                        // Type d'outil
                        Forms\Components\Select::make('category')
                            ->label('Type')
                            ->options([
                                'document' => 'Fichier / PDF',
                                'link' => 'Lien Web',
                            ])
                            ->required()
                            ->live(),

                        // Champ LIEN
                        Forms\Components\TextInput::make('link')
                            ->label('URL du lien')
                            ->url()
                            ->visible(fn(Forms\Get $get) => $get('category') === 'link')
                            ->required(fn(Forms\Get $get) => $get('category') === 'link'),

                        // Champ FICHIER (Correction pour voir le fichier existant)
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Fichier à télécharger')
                            ->directory('tools-files')
                            ->visibility('public')
                            ->openable()
                            ->downloadable()
                            ->visible(fn(Forms\Get $get) => $get('category') === 'document')
                            ->required(fn(Forms\Get $get) => $get('category') === 'document')

                            // --- LOGIQUE DE RENOMMAGE AUTOMATIQUE ---
                            ->getUploadedFileNameForStorageUsing(function (Forms\Get $get, $file): string {
                                // On récupère le titre FR, sinon le titre EN, sinon un nom par défaut
                                $titleFr = $get('title.fr');
                                $titleEn = $get('title.en');

                                $baseName = !empty($titleFr) ? $titleFr : (!empty($titleEn) ? $titleEn : 'document');

                                // On crée un "slug" propre (ex: "Avis de Divulgation" -> "avis-de-divulgation")
                                $slug = str($baseName)->slug();

                                // On ajoute un timestamp pour éviter les doublons et on garde l'extension originale
                                return (string) $slug->append('-' . time() . '.' . $file->getClientOriginalExtension());
                            }),

                        // DESCRIPTION BILINGUE (Ajoutée ici)
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Textarea::make('description.fr')
                                ->label('Description (Français)')
                                ->rows(3),
                            Forms\Components\Textarea::make('description.en')
                                ->label('Description (Anglais)')
                                ->rows(3),
                        ]),

                        Forms\Components\TextInput::make('position')
                            ->label('Ordre d\'affichage')
                            ->numeric()
                            ->default(0),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // --- AFFICHAGE DES DEUX LANGUES DANS LE TABLEAU ---
                Tables\Columns\TextColumn::make('title.fr')
                    ->label('Titre (FR)')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('title.en')
                    ->label('Titre (EN)')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Type')
                    ->badge()
                    ->colors([
                        'info' => 'link',
                        'warning' => 'document'
                    ]),

                Tables\Columns\TextColumn::make('position')
                    ->label('Ordre')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('position', 'asc'); // Changé ici aussi
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTools::route('/'),
            'create' => Pages\CreateTool::route('/create'),
            'edit' => Pages\EditTool::route('/{record}/edit'),
        ];
    }
}
