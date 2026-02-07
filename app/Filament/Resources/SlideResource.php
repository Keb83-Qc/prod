<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlideResource\Pages;
use App\Models\Slide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable; // Important
use Filament\Forms\Components\Tabs;

class SlideResource extends Resource
{
    use Translatable; // Active le mode multilingue

    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Slides / Carrousel';

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
                Section::make('Visuel')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('slides')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                // ONGLETS POUR LES LANGUES
                Tabs::make('Traductions')
                    ->tabs([
                        // ONGLET FRANÇAIS
                        Tabs\Tab::make('Français')
                            ->icon('heroicon-m-language')
                            ->schema([
                                TextInput::make('title_fr') // On utilise nos champs virtuels
                                    ->label('Titre (FR)')
                                    ->required(),

                                RichEditor::make('subtitle_fr')
                                    ->label('Sous-titre (FR)')
                                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList']),

                                TextInput::make('button_text_fr')
                                    ->label('Bouton (FR)'),
                            ]),

                        // ONGLET ANGLAIS
                        Tabs\Tab::make('Anglais')
                            ->icon('heroicon-m-globe-alt')
                            ->schema([
                                TextInput::make('title_en')
                                    ->label('Title (EN)'),

                                RichEditor::make('subtitle_en')
                                    ->label('Subtitle (EN)')
                                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList']),

                                TextInput::make('button_text_en')
                                    ->label('Button Text (EN)'),
                            ]),
                    ])->columnSpanFull(),

                Section::make('Configuration')
                    ->schema([
                        TextInput::make('button_link')
                            ->label('Lien du bouton (URL Commune)')
                            ->url(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->default(true),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Aperçu')
                    ->circular(),

                TextColumn::make('title')
                    ->label('Titre')
                    ->sortable()
                    ->searchable()
                    ->limit(30),

                TextColumn::make('subtitle')
                    ->label('Description')
                    ->html()
                    ->limit(50)
                    ->color('gray'),

                TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('En ligne'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
