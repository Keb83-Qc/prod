<?php

namespace App\Filament\Resources\CompagnieInfoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TypesRelationManager extends RelationManager
{
    protected static string $relationship = 'types';
    protected static ?string $title = 'Types de Placement';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom_type')
                    ->label('Nom du Type (ex: Fonds Distincts)')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nom_type')
            ->columns([
                Tables\Columns\TextColumn::make('nom_type')->label('Type'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Ajouter un type'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
