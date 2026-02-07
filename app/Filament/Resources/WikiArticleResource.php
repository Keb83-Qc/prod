<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WikiArticleResource\Pages;
use App\Models\WikiArticle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Support\Facades\Auth;

class WikiArticleResource extends Resource
{
    protected static ?string $model = WikiArticle::class;
    protected static ?string $modelLabel = 'Procédure';
    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationGroup(): ?string
    {
        return 'Espace Conseiller';
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    // ==========================================
    // 1. FORMULAIRE (Création / Édition)
    // ==========================================
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails de la procédure')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre du document')
                            ->required()
                            ->columnSpanFull()
                            ->placeholder("Ex: Procédure d'ouverture de dossier"),

                        Forms\Components\Select::make('category')
                            ->label('Catégorie')
                            ->options([
                                'Procédures Internes' => 'Procédures Internes',
                                'Conformité (Compliance)' => 'Conformité (Compliance)',
                                'Scripts de Vente' => 'Scripts de Vente',
                                'Produits & Assurances' => 'Produits & Assurances',
                                'Informatique & Outils' => 'Informatique & Outils',
                                'Ressources Humaines' => 'Ressources Humaines',
                                'Autre' => 'Autre',
                            ])
                            ->required()
                            ->searchable(),

                        Forms\Components\FileUpload::make('file_path')
                            ->label('Pièce jointe (PDF, Doc, Excel)')
                            ->directory('uploads/wiki')
                            ->downloadable()
                            ->openable(),

                        // Champ caché pour assigner l'auteur automatiquement
                        Forms\Components\Hidden::make('author_id')
                            ->default(fn() => Auth::id()),
                    ])->columns(2),

                Forms\Components\Section::make('Contenu')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Contenu explicatif')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    // ==========================================
    // 2. TABLEAU (Liste)
    // ==========================================
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn(WikiArticle $record) => 'Auteur: ' . ($record->author->full_name ?? 'Inconnu')),

                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mise à jour')
                    ->date('d/m/Y')
                    ->sortable(),

                // Bouton pour télécharger la pièce jointe directement depuis la liste
                Tables\Columns\TextColumn::make('file_path')
                    ->label('Fichier')
                    ->formatStateUsing(fn($state) => $state ? '📎 Document' : '')
                    ->url(fn(WikiArticle $record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->color('success'),
            ])
            // C'est ICI qu'on groupe par catégorie comme sur votre ancien site !
            ->groups([
                Tables\Grouping\Group::make('category')
                    ->label('Catégorie')
                    ->collapsible(),
            ])
            ->defaultGroup('category')
            ->actions([
                Tables\Actions\ViewAction::make(), // Bouton "Oeil" pour lire
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    // ==========================================
    // 3. VUE LECTURE (Remplace wiki_view.php)
    // ==========================================
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('category')
                            ->badge()
                            ->label(''),

                        Infolists\Components\TextEntry::make('title')
                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->label(''),

                        Infolists\Components\TextEntry::make('updated_at')
                            ->dateTime('d/m/Y à H:i')
                            ->label('Dernière mise à jour')
                            ->inlineLabel(),

                        // Affichage du fichier joint s'il existe
                        Infolists\Components\TextEntry::make('download_link')
                            ->label('Pièce jointe')
                            ->default('Télécharger le document')
                            ->url(fn(WikiArticle $record) => $record->file_url)
                            ->openUrlInNewTab()
                            ->icon('heroicon-m-document-arrow-down')
                            ->color('primary')
                            ->visible(fn(WikiArticle $record) => !empty($record->file_path)),

                        // Le contenu complet HTML
                        Infolists\Components\TextEntry::make('content')
                            ->html() // Important pour afficher le gras, les listes, etc.
                            ->label('')
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'prose max-w-none mt-4 p-4 bg-gray-50 rounded-lg']),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWikiArticles::route('/'),
            'create' => Pages\CreateWikiArticle::route('/create'),
            'view' => Pages\ViewWikiArticle::route('/{record}'), // Route pour la lecture
            'edit' => Pages\EditWikiArticle::route('/{record}/edit'),
        ];
    }
}
