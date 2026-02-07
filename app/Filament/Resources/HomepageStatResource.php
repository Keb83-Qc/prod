<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomepageStatResource\Pages;
use App\Models\HomepageStat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;

class HomepageStatResource extends Resource
{
    protected static ?string $model = HomepageStat::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Statistiques';

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
                Forms\Components\Section::make('Chiffres')->schema([
                    Forms\Components\TextInput::make('value')->numeric()->required()->label('Valeur (ex: 3000)'),
                    Forms\Components\TextInput::make('suffix')->label('Suffixe (ex: +, %)'),
                    Forms\Components\TextInput::make('sort_order')->label('Ordre')->numeric()->default(0),
                ])->columns(3),

                Tabs::make('Traductions')->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('Français')->icon('heroicon-m-language')
                            ->schema([Forms\Components\TextInput::make('label_fr')->label('Libellé (FR)')->required()]),
                        Tabs\Tab::make('Anglais')->icon('heroicon-m-globe-alt')
                            ->schema([Forms\Components\TextInput::make('label_en')->label('Label (EN)')]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value')->label('Valeur')->sortable(),
                Tables\Columns\TextColumn::make('suffix'),
                Tables\Columns\TextColumn::make('label_fr')->label('Libellé'),
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
            'index' => Pages\ListHomepageStats::route('/'),
            'create' => Pages\CreateHomepageStat::route('/create'),
            'edit' => Pages\EditHomepageStat::route('/{record}/edit'),
        ];
    }
}
