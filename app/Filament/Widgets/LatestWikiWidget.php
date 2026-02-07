<?php

namespace App\Filament\Widgets;

use App\Models\WikiArticle;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestWikiWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1; // Prend 1 colonne

    protected static ?string $heading = 'Dernières Procédures';

    public function table(Table $table): Table
    {
        return $table
            ->query(WikiArticle::query()->latest('updated_at')->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color('info')
                    ->label('Catégorie'),
            ])
            ->paginated(false)
            ->recordUrl(fn(WikiArticle $record) => \App\Filament\Resources\WikiArticleResource::getUrl('view', ['record' => $record]));
    }
}
