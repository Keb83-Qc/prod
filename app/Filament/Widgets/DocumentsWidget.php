<?php

namespace App\Filament\Widgets;

use App\Models\Tool;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DocumentsWidget extends BaseWidget
{
    protected static ?int $sort = 5; // Ordre d'affichage
    protected int | string | array $columnSpan = 1; // Prend 1 colonne sur 2
    protected static ?string $heading = '📂 Documents Utiles';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // On ne prend que les documents
                Tool::query()->where('category', 'document')
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Nom du fichier')
                    ->weight('bold')
                    ->icon('heroicon-o-document-text'),
            ])
            ->actions([
                // Action pour télécharger
                Tables\Actions\Action::make('download')
                    ->label('Télécharger')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Tool $record) => asset('storage/' . $record->image))
                    ->openUrlInNewTab(),
            ])
            ->paginated(false); // Pas de pagination (liste simple)
    }
}
