<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemLogResource\Pages;
use App\Models\SystemLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SystemLogResource extends Resource
{
    protected static ?string $model = SystemLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationLabel = 'Logs Système';

    public static function getNavigationGroup(): ?string
    {
        return 'Configuration';
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    // SÉCURITÉ : Seul le Super Admin voit ça
    public static function canViewAny(): bool
    {
        return auth()->user()->isSuperAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('level')
                    ->label('Niveau')
                    ->readOnly(),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Date')
                    ->readOnly(),
                Forms\Components\Textarea::make('message')
                    ->label('Message')
                    ->columnSpanFull()
                    ->readOnly(),

                // ZONE JSON (Corrigée avec Textarea)
                Forms\Components\Textarea::make('context')
                    ->label('Détails techniques (JSON complet)')
                    ->columnSpanFull()
                    ->rows(15)
                    ->readOnly()
                    ->extraAttributes(['class' => 'font-mono']) // Police style "code"
                    // Transformation du tableau PHP en texte JSON lisible
                    ->formatStateUsing(fn($state) => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)),

                Forms\Components\TextInput::make('ip_address')
                    ->label('Adresse IP de l\'auteur')
                    ->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('level')
                    ->badge()
                    ->colors([
                        'danger' => 'fatal',
                        'warning' => 'error',
                        'info' => 'info',
                        'success' => 'update',
                    ])
                    ->formatStateUsing(fn(string $state): string => strtoupper($state)),

                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Utilisateur')
                    ->placeholder('Système'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('Adresse IP')
                    ->searchable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('voir_json')
                    ->label('Voir JSON')
                    ->icon('heroicon-o-code-bracket')
                    ->modalHeading('Détails Techniques')
                    ->modalContent(fn($record) => new \Illuminate\Support\HtmlString(
                        '<pre style="white-space: pre-wrap; font-size: 0.85em; background: #f3f4f6; padding: 10px; border-radius: 8px;">' .
                            json_encode($record->context, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
                            '</pre>'
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false),
            ])
            // --- AJOUT : BOUTON POUR VIDER LES LOGS ---
            ->headerActions([
                Tables\Actions\Action::make('clear_logs')
                    ->label('Vider l\'historique')
                    ->icon('heroicon-o-trash')
                    ->color('danger') // Rouge
                    ->requiresConfirmation() // Demande "Êtes-vous sûr ?"
                    ->modalHeading('Supprimer tous les logs ?')
                    ->modalDescription('Cette action est irréversible. Tout l\'historique système sera effacé.')
                    ->modalSubmitActionLabel('Oui, tout supprimer')
                    ->action(function () {
                        // On vide la table complètement (c'est plus rapide que delete())
                        SystemLog::truncate();

                        \Filament\Notifications\Notification::make()
                            ->title('Historique vidé avec succès')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSystemLogs::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }
}
