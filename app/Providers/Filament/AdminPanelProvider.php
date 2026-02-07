<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use App\Filament\Pages\EditProfile;
use Filament\Navigation\MenuItem;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Navigation\NavigationGroup;
use Filament\Forms\Components\Section;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        // On dit à Filament que TOUTES les Sections doivent être refermables
        Section::configureUsing(function (Section $section): void {
            $section
                ->collapsible()        // Rend la section refermable
                ->persistCollapsed();  // Garde en mémoire le choix de l'utilisateur
        });
    }

    public function panel(Panel $panel): Panel
    {
        // Récupération de votre config de navigation centralisée
        $navConfig = config('filament-navigation.groups', []);

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#c9a050'),
                'gray' => Color::Slate,
            ])
            ->font('Montserrat')
            ->brandName('VIP GPI')
            ->brandLogo(asset('assets/img/VIP_Logo_Gold_Gradient10.png'))
            ->brandLogoHeight('3rem')
            ->sidebarCollapsibleOnDesktop()
            ->darkMode(true)

            // --- HOOK DE RENDU : STYLE & IMPRESSION ---
            ->renderHook(
                'panels::head.end',
                fn(): string => '
                <style>
                    /* Style Sidebar header */
                    .fi-sidebar-header { background-color: #0E1030 !important; border-bottom: 1px solid #c9a050; }

                    @media print {
                        /* 1. Cacher tout le site sauf les modales */
                        body > *:not(.fi-modal),
                        .fi-sidebar,
                        .fi-topbar,
                        .fi-layout-main-topbar {
                            display: none !important;
                        }

                        /* 2. Traiter la modale Filament pour qu elle soit seule */
                        .fi-modal {
                            position: absolute !important;
                            left: 0 !important;
                            top: 0 !important;
                            width: 100% !important;
                            display: block !important;
                        }

                        /* EMPECHE LA RÉPÉTITION (LE DOUBLON) */
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

                        /* 3. Cacher l interface (boutons, pieds de page) */
                        .fi-modal-footer,
                        .fi-modal-close-btn,
                        .fi-btn,
                        .fi-icon-btn,
                        .fi-modal-close-overlay {
                            display: none !important;
                        }

                        /* 4. Marges papier */
                        @page { margin: 1cm !important; }
                        body { background: white !important; padding: 0 !important; margin: 0 !important; }
                    }
                </style>'
            )

            ->bootUsing(function () {
                Section::configureUsing(fn(Section $section) => $section->collapsible()->persistCollapsed());
            })

            // Navigation centralisée
            ->navigationGroups(
                collect($navConfig)
                    ->sortBy('sort')
                    ->map(function ($group) {
                        return NavigationGroup::make()
                            ->label($group['label'])
                            ->icon($group['icon'])
                            ->collapsible(true)
                            ->collapsed(false);
                    })
                    ->toArray()
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                EditProfile::class,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Mon Profil')
                    ->url(fn(): string => EditProfile::getUrl())
                    ->icon('heroicon-o-user-circle'),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
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
}
