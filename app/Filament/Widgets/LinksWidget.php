<?php

namespace App\Filament\Widgets;

use App\Models\Tool;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LinksWidget extends BaseWidget
{
    protected static ?int $sort = 5; // Même ordre que l'autre pour s'aligner
    protected int | string | array $columnSpan = 1; // L'autre moitié de l'écran
    protected static ?string $heading = '🔗 Liens Rapides';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // On ne prend que les liens
                Tool::query()->where('category', 'link')
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Service')
                    ->weight('bold')
                    ->description(fn(Tool $record) => $record->subtitle ?? '') // Si vous avez un sous-titre
                    ->icon('heroicon-o-globe-alt'),
            ])
            ->actions([
                // Action pour ouvrir le lien
                Tables\Actions\Action::make('open')
                    ->label('Ouvrir')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(fn(Tool $record) => $record->action_url)
                    ->openUrlInNewTab()
                    ->button() // Style bouton pour que ça ressorte mieux
                    ->size('xs'),
            ])
            ->paginated(false);
    }
}
