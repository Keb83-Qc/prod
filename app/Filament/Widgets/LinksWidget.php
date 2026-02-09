<?php

namespace App\Filament\Widgets;

use App\Models\Tool;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class LinksWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    protected int|string|array $columnSpan = 1;
    protected static ?string $heading = '🔗 Liens Rapides';

    public function table(Table $table): Table
    {
        $user = Filament::auth()->user();

        // ✅ toujours retourner une table valide
        try {
            $query = Tool::query()->where('category', 'link');

            // Si pas loggé => aucun résultat (pas de crash)
            if (! $user) {
                $query->whereRaw('1=0');
            } else {
                // ✅ filtre DB par visible_to_roles si la colonne existe
                if (Schema::hasColumn('tools', 'visible_to_roles')) {
                    $roleName = $user->role?->name ?? ($user->getRoleNames()->first() ?? null);

                    $query->where(function (Builder $q) use ($roleName) {
                        // NULL = visible à tous
                        $q->whereNull('visible_to_roles')
                            ->orWhereJsonContains('visible_to_roles', 'all');

                        if ($roleName) {
                            $q->orWhereJsonContains('visible_to_roles', $roleName);
                        }
                    });
                }
            }

            return $table
                ->query($query)
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
                        ->url(fn(Tool $record) => $record->action_url ?: '#')
                        ->openUrlInNewTab()
                        ->button()
                        ->size('xs')
                        ->visible(fn(Tool $record) => ! empty($record->action_url)),
                ])
                ->paginated(false);
        } catch (\Throwable $e) {
            // ✅ si ça casse, on évite de faire planter Livewire / Dashboard
            report($e);

            Notification::make()
                ->danger()
                ->title('LinksWidget: erreur de chargement')
                ->body('Vérifie la table tools, la colonne visible_to_roles et les données.')
                ->send();

            return $table
                ->query(Tool::query()->whereRaw('1=0'))
                ->columns([
                    Tables\Columns\TextColumn::make('title')
                        ->label('Service'),
                ])
                ->paginated(false);
        }
    }
}
