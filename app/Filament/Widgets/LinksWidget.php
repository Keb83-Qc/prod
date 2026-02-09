<?php

namespace App\Filament\Widgets;

use App\Models\Tool;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LinksWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 1;
    protected static ?string $heading = '🔗 Liens Rapides';

    public function table(Table $table): Table
    {
        $user = Filament::auth()->user();

        // ⚠️ si pas loggé, on montre rien (ou enlève ça si tu veux)
        if (! $user) {
            return $table->query(Tool::query()->whereRaw('1=0'));
        }

        // On prend le rôle "principal" selon ton système role_id (et fallback spatie)
        $roleName = $user->role?->name ?? ($user->getRoleNames()->first() ?? null);

        return $table
            ->query(
                Tool::query()
                    ->where('category', 'link')
                    ->where(function (Builder $q) use ($roleName) {
                        // NULL = visible à tous
                        $q->whereNull('visible_to_roles');

                        if ($roleName) {
                            // visible à ce rôle ou à "all"
                            $q->orWhereJsonContains('visible_to_roles', 'all')
                                ->orWhereJsonContains('visible_to_roles', $roleName);
                        }
                    })
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Service')
                    ->weight('bold')
                    ->description(fn(Tool $record) => $record->subtitle ?? '')
                    ->icon('heroicon-o-globe-alt'),
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                    ->label('Ouvrir')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(fn(Tool $record) => $record->action_url)
                    ->openUrlInNewTab()
                    ->button()
                    ->size('xs'),
            ])
            ->paginated(false);
    }
}
