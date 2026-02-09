<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AbfPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('abf')
            ->path('abf')

            // Si tu veux que ABF ait son propre login, garde ->login().
            // Sinon, si tes users sont déjà connectés via admin, ça marche aussi.
            ->login()

            // Full width ABF (global au panel ABF)
            ->maxContentWidth('full')

            ->colors([
                'primary' => Color::hex('#c9a050'),
                'gray'    => Color::Slate,
            ])
            ->font('Montserrat')
            ->brandName('VIP GPI — ABF')
            ->brandLogo(asset('assets/img/VIP_Logo_Gold_Gradient10.png'))
            ->brandLogoHeight('3rem')

            // ✅ Panel “focus” : pas de sidebar (CSS-only, stable)
            ->renderHook('panels::body.start', fn() => '<div class="abf-panel"></div>')
            ->renderHook('panels::head.end', fn() => $this->abfFocusCss())

            // ✅ Ne découvre QUE les ressources ABF (dans un dossier dédié)
            ->discoverResources(in: app_path('Filament/Abf/Resources'), for: 'App\\Filament\\Abf\\Resources')
            ->discoverPages(in: app_path('Filament/Abf/Pages'), for: 'App\\Filament\\Abf\\Pages')
            ->discoverWidgets(in: app_path('Filament/Abf/Widgets'), for: 'App\\Filament\\Abf\\Widgets')

            // Middleware standard Filament
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    private function abfFocusCss(): string
    {
        return <<<'HTML'
<style>
/* ==========================================================================
ABF PANEL (focus)
- Cache sidebar + topbar
- Met le contenu en vrai full width
========================================================================== */
.abf-panel ~ .fi-layout .fi-sidebar,
.abf-panel ~ .fi-layout .fi-topbar,
.abf-panel ~ .fi-layout .fi-layout-main-topbar {
    display: none !important;
}

.abf-panel ~ .fi-layout .fi-main,
.abf-panel ~ .fi-layout .fi-page-body,
.abf-panel ~ .fi-layout .fi-container,
.abf-panel ~ .fi-layout .fi-main-ctn,
.abf-panel ~ .fi-layout .fi-page,
.abf-panel ~ .fi-layout .fi-page-header {
    max-width: none !important;
    width: 100% !important;
}

.abf-panel ~ .fi-layout .fi-main,
.abf-panel ~ .fi-layout .fi-page-body {
    padding-left: 1rem !important;
    padding-right: 1rem !important;
}
</style>
HTML;
    }
}
