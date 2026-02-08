<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbfCaseResource\Pages;
use App\Models\AbfCase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AbfCaseResource extends Resource
{
    protected static ?string $model = AbfCase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Analyse des besoins financiers';

    public static function getNavigationGroup(): ?string
    {
        return 'Espace Conseiller';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('advisor_user_id', auth()->id());
    }


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('advisor_code')
                ->label('Code conseiller')
                ->disabled()
                ->dehydrated()
                ->default(fn() => auth()->user()->advisor_code),

            Forms\Components\Select::make('status')
                ->label('Statut')
                ->options([
                    'draft' => 'Brouillon',
                    'completed' => 'Complété',
                    'signed' => 'Signé',
                ])
                ->default('draft')
                ->required(),

            Forms\Components\Textarea::make('payload.notes')
                ->label('Notes')
                ->rows(5),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('client_name')
                    ->label('Client')
                    ->state(fn($record) => trim(
                        ($record->payload['client']['first_name'] ?? '') . ' ' . ($record->payload['client']['last_name'] ?? '')
                    ) ?: '—'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'completed' => 'warning',
                        'signed' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ouvrir'),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListAbfCases::route('/'),
            'create' => Pages\CreateAbfCase::route('/create'),
            'edit' => Pages\EditAbfCase::route('/{record}/edit'),
        ];
    }
}
