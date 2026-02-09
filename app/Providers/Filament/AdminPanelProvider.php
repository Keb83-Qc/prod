<?php

namespace App\Providers\Filament;

use App\Filament\Pages\EditProfile;
use App\Filament\Widgets\DocumentsWidget;
use App\Filament\Widgets\LatestUsersWidget;
use App\Filament\Widgets\LatestWikiWidget;
use App\Filament\Widgets\LinksWidget;
use App\Filament\Widgets\QuickLinks;
use App\Filament\Widgets\WelcomeOverview;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Forms\Components\Section;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        // Toutes les Sections Filament collapsibles + persist
        Section::configureUsing(static function (Section $section): void {
            $section->collapsible()->persistCollapsed();
        });
    }

    public function panel(Panel $panel): Panel
    {
        $navConfig = config('filament-navigation.groups', []);

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()

            // ✅ FULL SCREEN GLOBAL (toutes les pages Filament)
            ->maxContentWidth('full')

            ->colors([
                'primary' => Color::hex('#c9a050'),
                'gray'    => Color::Slate,
            ])
            ->font('Montserrat')
            ->brandName('VIP GPI')
            ->brandLogo(asset('assets/img/VIP_Logo_Gold_Gradient10.png'))
            ->brandLogoHeight('3rem')
            ->sidebarCollapsibleOnDesktop()
            ->darkMode(true)

            // ✅ Inline CSS + JS (pas de Vite, pas de manifest, pas de npm requis)
            ->renderHook('panels::head.end', fn(): string => $this->globalStylesAndScripts())

            ->navigationGroups(
                collect($navConfig)
                    ->sortBy('sort')
                    ->map(
                        fn($group) => NavigationGroup::make()
                            ->label($group['label'])
                            ->icon($group['icon'])
                            ->collapsible(true)
                            ->collapsed(false)
                    )
                    ->toArray()
            )
            ->navigationItems($this->buildNavigationItems())
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                EditProfile::class,
            ])

            // ✅ Dashboard widgets (tes widgets)
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                WelcomeOverview::class,
                QuickLinks::class,
                LinksWidget::class,
                DocumentsWidget::class,
                LatestUsersWidget::class,
                LatestWikiWidget::class,
            ])

            ->userMenuItems([
                MenuItem::make()
                    ->label('Mon Profil')
                    ->url(fn(): string => EditProfile::getUrl())
                    ->icon('heroicon-o-user-circle'),
            ])

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

            ->plugins([
                FilamentShieldPlugin::make(),
                SpatieLaravelTranslatablePlugin::make()->defaultLocales(['fr', 'en']),
            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    private function buildNavigationItems(): array
    {
        $links = config('filament-navigation.links', []);

        return collect($links)
            ->sortBy('sort')
            ->map(function (array $link) {
                $item = NavigationItem::make($link['label'])
                    ->label($link['label'])
                    ->icon($link['icon'] ?? null)
                    ->url(url($link['url']))
                    ->group($link['group'] ?? null);

                if (!empty($link['new_tab'])) {
                    $item->openUrlInNewTab();
                }

                return $item;
            })
            ->toArray();
    }


    private function globalStylesAndScripts(): string
    {
        return <<<'HTML'
<style>
/* ==========================================================================
FULL WIDTH GLOBAL (tout Filament)
========================================================================== */
.fi-page,
.fi-page-header,
.fi-page-body,
.fi-main,
.fi-main-ctn,
.fi-container {
    max-width: none !important;
}

/* Garde des marges respirables */
.fi-main,
.fi-page-body {
    padding-left: 1rem !important;
    padding-right: 1rem !important;
}

/* ==========================================================================
THEME / GLOBAL
========================================================================== */
.fi-sidebar-header {
    background-color: #0E1030 !important;
    border-bottom: 1px solid #c9a050;
}

/* ==========================================================================
TABLES (plus compact)
========================================================================== */
.fi-ta-cell {
    padding-top: 0.35rem !important;
    padding-bottom: 0.25rem !important;
    padding-left: 0.5rem !important;
    padding-right: 0.35rem !important;
}
.fi-ta-row { min-height: 2.25rem !important; }

/* ==========================================================================
STICKY HEADER (boutons toujours visibles)
========================================================================== */
/* Page header sticky, mais limité à la zone main */
.fi-header {
    position: sticky;
    top: 0;
    z-index: 50 !important; /* OK, sidebar est 1000 */
    background: rgba(15, 23, 42, 0.92);
    backdrop-filter: blur(6px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}

/* ✅ Sidebar au-dessus du header sticky */
.fi-sidebar {
    z-index: 1000 !important;
}

/* (Optionnel) renforce les éléments internes */
.fi-sidebar-header,
.fi-sidebar-nav {
    z-index: 61 !important;
}

/* ✅ Sur desktop, on “décale” le header pour qu’il commence après la sidebar */
@media (min-width: 1024px) {
    .fi-header {
        left: var(--fi-sidebar-width, 18rem);
        width: calc(100% - var(--fi-sidebar-width, 18rem));
    }
}

/* ==========================================================================
LIGHT MODE UPGRADE (améliore le look clair)
========================================================================== */
html:not(.dark) body {
    background: #f3f6fb !important;
}
html:not(.dark) .fi-topbar,
html:not(.dark) .fi-header {
    background: rgba(255,255,255,0.85) !important;
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(15, 23, 42, 0.08) !important;
}
html:not(.dark) .fi-section,
html:not(.dark) .fi-wi,
html:not(.dark) .fi-card,
html:not(.dark) .fi-ta-ctn {
    background: rgba(255,255,255,0.90) !important;
    border: 1px solid rgba(15, 23, 42, 0.06) !important;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06) !important;
    border-radius: 16px !important;
}
html:not(.dark) .fi-ta-row:hover {
    background: rgba(2, 6, 23, 0.04) !important;
}
html:not(.dark) .fi-ta-header-cell {
    background: rgba(2, 6, 23, 0.03) !important;
}

/* “Welcome” widget: moins gros / moins agressif */
html:not(.dark) .fi-wi-header {
    padding: 0.75rem 1rem !important;
}
html:not(.dark) .fi-wi-header h2,
html:not(.dark) .fi-wi-header h3 {
    font-size: 1rem !important;
    font-weight: 700 !important;
    color: #0f172a !important;
}

/* ==========================================================================
PRINT (modales seulement)
========================================================================== */
@media print {
    body > *:not(.fi-modal),
    .fi-sidebar,
    .fi-topbar,
    .fi-layout-main-topbar {
        display: none !important;
    }

    .fi-modal {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
        display: block !important;
    }

    .fi-modal:not(:last-child) {
        display: none !important;
    }

    .fi-modal-window {
        visibility: visible !important;
        display: block !important;
        position: relative !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
        background: white !important;
    }

    .fi-modal-footer,
    .fi-modal-close-btn,
    .fi-btn,
    .fi-icon-btn,
    .fi-modal-close-overlay {
        display: none !important;
    }

    @page { margin: 1cm !important; }
    body { background: white !important; padding: 0 !important; margin: 0 !important; }
}
</style>

<script>
/**
 * ABF Wizard UX:
 * Rend cliquables les steps déjà atteints (utile sur ABF)
 * Requis: le Wizard a la classe .abf-wizard (dans AbfCaseResource)
 */
(function () {
    function unlockWizardSteps() {
        const wizard = document.querySelector('.abf-wizard');
        if (!wizard) return;

        const header = wizard.querySelector('.fi-fo-wizard-header');
        if (!header) return;

        const buttons = Array.from(header.querySelectorAll('button'));
        if (!buttons.length) return;

        const key = 'abf_wizard_max_' + window.location.pathname;

        const activeIndex = buttons.findIndex((b) => b.getAttribute('aria-current') === 'step');
        if (activeIndex >= 0) {
            const currentMax = parseInt(localStorage.getItem(key) || '0', 10);
            localStorage.setItem(key, String(Math.max(currentMax, activeIndex)));
        }

        const maxVisited = parseInt(localStorage.getItem(key) || '0', 10);

        buttons.forEach((btn, idx) => {
            if (idx <= maxVisited) {
                btn.removeAttribute('disabled');
                btn.style.pointerEvents = 'auto';
                btn.style.opacity = '1';
                btn.style.cursor = 'pointer';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', unlockWizardSteps);
    document.addEventListener('livewire:initialized', unlockWizardSteps);
    document.addEventListener('livewire:navigated', unlockWizardSteps);

    if (window.Livewire && typeof window.Livewire.hook === 'function') {
        window.Livewire.hook('morph.updated', () => unlockWizardSteps());
        window.Livewire.hook('commit', () => setTimeout(unlockWizardSteps, 0));
    }
})();
</script>
HTML;
    }
}
