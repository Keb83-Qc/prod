<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Tableau de bord';
    protected static ?string $title = 'Tableau de bord';

    // ✅ enlève le sous-titre/welcome
    public function getSubheading(): ?string
    {
        return null;
    }

    // ✅ full aussi ici (au cas où)
    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }

    /**
     * Mets ici TES widgets (si tu en as)
     * Ex:
     * return [\App\Filament\Widgets\MyWidget::class];
     */
    public function getWidgets(): array
    {
        return [];
    }

    public function getColumns(): int|string|array
    {
        return 12;
    }
}
