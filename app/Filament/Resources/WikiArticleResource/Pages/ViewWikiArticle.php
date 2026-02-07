<?php

namespace App\Filament\Resources\WikiArticleResource\Pages;

use App\Filament\Resources\WikiArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWikiArticle extends ViewRecord
{
    protected static string $resource = WikiArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Le bouton Imprimer personnalisé en Javascript
            Actions\Action::make('print')
                ->label('Imprimer')
                ->icon('heroicon-o-printer')
                ->url('#')
                ->extraAttributes(['onclick' => 'window.print(); return false;']),

            Actions\EditAction::make(),
        ];
    }
}
