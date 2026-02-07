<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import important
use Illuminate\Support\Facades\DB;   // Import important
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });

        Paginator::useBootstrapFive();
        // Empêche les erreurs de migration sur certaines versions MySQL
        Schema::defaultStringLength(191);

        // On partage la variable $settings avec TOUTES les vues
        // On enveloppe dans un try/catch pour ne pas planter si la table n'existe pas encore
        try {
            if (Schema::hasTable('settings')) {
                // On récupère tout sous forme de tableau clé/valeur pour garder votre logique actuelle
                $settingsData = DB::table('settings')->pluck('setting_value', 'setting_key')->toArray();

                View::share('settings', $settingsData);
            } else {
                View::share('settings', []);
            }
        } catch (\Exception $e) {
            View::share('settings', []);
        }
    }
}