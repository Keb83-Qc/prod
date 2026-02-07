<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoogleReviewResource\Pages;
use App\Models\GoogleReview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class GoogleReviewResource extends Resource
{
    protected static ?string $model = GoogleReview::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Avis Google';
    protected static ?string $navigationGroup = 'Marketing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails de l\'avis')
                    ->schema([
                        Forms\Components\TextInput::make('author_name')
                            ->label('Auteur')
                            ->disabled(), // On ne modifie pas les avis Google

                        Forms\Components\TextInput::make('rating')
                            ->label('Note')
                            ->numeric()
                            ->disabled(),

                        Forms\Components\DateTimePicker::make('review_time')
                            ->label('Date')
                            ->disabled(),

                        Forms\Components\Textarea::make('text')
                            ->label('Commentaire')
                            ->rows(5)
                            ->columnSpanFull()
                            ->disabled(),

                        Forms\Components\Toggle::make('is_visible')
                            ->label('Afficher sur le site')
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Photo de l'auteur
                Tables\Columns\ImageColumn::make('author_photo_url')
                    ->label('Photo')
                    ->circular(),

                // Nom
                Tables\Columns\TextColumn::make('author_name')
                    ->label('Auteur')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // Note (ex: 5) avec badge couleur
                Tables\Columns\TextColumn::make('rating')
                    ->label('Note')
                    ->badge()
                    ->color(fn(string $state): string => match (true) {
                        $state >= 5 => 'success',
                        $state >= 4 => 'warning',
                        default => 'danger',
                    })
                    ->sortable(),

                // Extrait du commentaire
                Tables\Columns\TextColumn::make('text')
                    ->label('Commentaire')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                // Date relative (ex: il y a 2 jours)
                Tables\Columns\TextColumn::make('review_time')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->sortable(),

                // LE SWITCH MAGIQUE : Pour cacher/afficher directement depuis la liste
                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Visible')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->defaultSort('review_time', 'desc') // Les plus récents en premier
            ->filters([
                // Filtre pour ne voir que les avis cachés par exemple
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Visibilité'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Voir le détail
                // Pas de EditAction car on ne modifie pas un avis Google
                Tables\Actions\DeleteAction::make(), // Supprimer de la base locale
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
            'index' => Pages\ListGoogleReviews::route('/'),
            // On retire 'create' car on ne crée pas de faux avis
            // 'create' => Pages\CreateGoogleReview::route('/create'),
            // 'edit' => Pages\EditGoogleReview::route('/{record}/edit'),
        ];
    }

    // Pour interdire la création manuelle d'avis
    public static function canCreate(): bool
    {
        return false;
    }
}
