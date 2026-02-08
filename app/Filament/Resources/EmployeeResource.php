<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationLabel = 'Gestion Zoho People';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion Conseillers';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations principales')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('zoho_id')
                        ->label('ID Unique Zoho')
                        ->disabled()
                        ->dehydrated(false),

                    Forms\Components\TextInput::make('employee_number')
                        ->label('EmployeeID (code interne)')
                        ->disabled()
                        ->dehydrated(false),

                    Forms\Components\TextInput::make('name')
                        ->label('Nom complet')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('role')
                        ->label('Rôle / Poste')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('status')
                        ->label('Statut')
                        ->maxLength(255),
                ]),

            Forms\Components\Section::make('Dossier Zoho complet (JSON)')
                ->collapsed()
                ->schema([
                    Forms\Components\Textarea::make('zoho_payload')
                        ->label('Zoho payload')
                        ->disabled()
                        ->dehydrated(false)
                        ->rows(18)
                        ->formatStateUsing(function ($state) {
                            if (is_array($state)) {
                                return json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                            }
                            return (string) $state;
                        }),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nom')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('role')->label('Rôle')->badge(),
                Tables\Columns\TextColumn::make('status')->label('Statut')->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'edit'  => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
