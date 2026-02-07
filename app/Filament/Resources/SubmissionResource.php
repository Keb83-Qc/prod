<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages;
use App\Models\Submission;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Builder;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'Soumissions Auto';

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion Clients';
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->isSuperAdmin();
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        // Si l'utilisateur est Super Admin ou Admin, il voit tout
        if ($user->isSuperAdmin() || $user->hasRole('admin')) {
            return $query;
        }

        // Sinon (pour les conseillers), on ne montre que les soumissions
        // qui ont leur code conseiller
        return $query->where('advisor_code', $user->advisor_code);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Placeholder::make('fiche_titre')
                    ->label('')
                    ->columnSpanFull()
                    ->content(fn($record) => new HtmlString(
                        '<div style="text-align: center; border-bottom: 2px solid #c9a050; padding-bottom: 10px; margin-bottom: 20px;">' .
                            '<h1 style="font-size: 2rem; font-weight: bold; color: #0E1030; text-transform: uppercase;">' .
                            'Fiche Soumission : ' . ($record->data['first_name'] ?? '') . ' ' . ($record->data['last_name'] ?? '') .
                            '</h1>' .
                            '</div>'
                    )),
                Forms\Components\Section::make('Informations Client')
                    ->compact()
                    ->schema([
                        // Le Placeholder affiche le texte brut, idéal pour l'impression
                        Forms\Components\Placeholder::make('first_name')
                            ->label('Prénom')
                            ->content(fn($record) => $record->data['first_name'] ?? '-'),

                        Forms\Components\Placeholder::make('last_name')
                            ->label('Nom de famille')
                            ->content(fn($record) => $record->data['last_name'] ?? '-'),

                        Forms\Components\Placeholder::make('email')
                            ->label('Courriel')
                            ->content(fn($record) => $record->data['email'] ?? '-'),

                        Forms\Components\Placeholder::make('phone')
                            ->label('Téléphone')
                            ->content(fn($record) => $record->data['phone'] ?? '-'),

                        Forms\Components\Placeholder::make('birth_date')
                            ->label('Date de naissance')
                            ->content(fn($record) => isset($record->data['birth_date'])
                                ? \Carbon\Carbon::parse($record->data['birth_date'])->translatedFormat('d F Y')
                                : '-'),
                    ])->columns(2),

                Forms\Components\Section::make('Informations Véhicule')
                    ->compact()
                    ->schema([
                        Forms\Components\Placeholder::make('vehicule_titre')
                            ->label('Véhicule sélectionné')
                            ->columnSpanFull()
                            ->content(fn($record) => new HtmlString(
                                '<span style="font-size: 1.1rem; font-weight: bold; color: #c9a050;">' .
                                    ($record->data['vehicle_year'] ?? $record->data['year'] ?? '') . ' ' .
                                    ($record->data['vehicle_brand_name'] ?? $record->data['brand'] ?? '') . ' ' .
                                    ($record->data['vehicle_model_name'] ?? $record->data['model'] ?? '') . '</span>'
                            )),

                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\Placeholder::make('usage')
                                ->label('Usage')
                                ->content(fn($record) => $record->data['usage'] ?? '-'),

                            Forms\Components\Placeholder::make('km_annuel')
                                ->label('KM Annuel')
                                ->content(fn($record) => $record->data['km_annuel'] ?? '-'),

                            Forms\Components\Placeholder::make('address')
                                ->label('Adresse complète')
                                ->content(fn($record) => $record->data['address'] ?? '-'),
                        ]),
                    ]),

                Forms\Components\Section::make('Suivi')
                    ->compact()
                    ->schema([
                        Forms\Components\Placeholder::make('advisor')
                            ->label('Conseiller lié')
                            ->content(fn($record) => $record->advisor_code ?? 'Aucun'),

                        Forms\Components\Placeholder::make('created_at')
                            ->label('Date de réception')
                            ->content(fn($record) => $record->created_at->format('d/m/Y H:i')),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('data.email')->label('Client')->searchable(),
                Tables\Columns\TextColumn::make('vehicule')
                    ->label('Véhicule')
                    ->getStateUsing(fn($record) => trim(
                        ($record->data['vehicle_year'] ?? $record->data['year'] ?? '') . ' ' .
                            ($record->data['vehicle_brand_name'] ?? $record->data['brand'] ?? '')
                    ))
                    ->weight('bold')->color('primary'),
                Tables\Columns\TextColumn::make('created_at')->label('Reçu le')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Voir la fiche')
                    ->modalHeading('Détails de la soumission')
                    ->modalSubmitAction(false), // Cache le bouton "Enregistrer"
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSubmissions::route('/'),
        ];
    }
}
