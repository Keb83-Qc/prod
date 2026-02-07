<?php

namespace App\Filament\Resources\WikiArticleResource\Pages;

use App\Filament\Resources\WikiArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWikiArticle extends CreateRecord
{
    protected static string $resource = WikiArticleResource::class;

    // Optionnel : Rediriger vers la liste après la création
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
