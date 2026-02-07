<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeOverview extends Widget
{
    protected static ?int $sort = 1; // Priorité absolue
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.widgets.welcome-overview';
}
