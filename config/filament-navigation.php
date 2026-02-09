<?php

return [
    'groups' => [
        'Espace Conseiller' => [
            'label' => 'Espace Conseiller',
            'icon'  => 'heroicon-o-user-group',
            'sort'  => 1,
        ],
        'Gestion Clients' => [
            'label' => 'Gestion Clients',
            'icon'  => 'heroicon-o-briefcase',
            'sort'  => 2,
        ],
        'Marketing' => [
            'label' => 'Marketing & Blog', // Changé ici
            'icon'  => 'heroicon-o-megaphone', // Icône plus adaptée
            'sort'  => 3,
        ],
        'Configuration' => [
            'label' => 'Paramètres Système',
            'icon'  => 'heroicon-o-cog-6-tooth',
            'sort'  => 4,
        ],
        'Gestion Conseillers' => [
            'label' => 'Gestion Conseillers',
            'icon'  => 'heroicon-o-user-group',
            'sort'  => 5,
        ],
    ],

    'sort' => [
        \App\Filament\Resources\MessageResource::class => 1,
        \App\Filament\Resources\WikiArticleResource::class => 1,
        \App\Filament\Pages\CommissionCalculator::class => 1,

        \App\Filament\Resources\SubmissionResource::class => 2,

        \App\Filament\Resources\BlogPostResource::class => 3,
        \App\Filament\Resources\HomepageStatResource::class => 3,
        \App\Filament\Resources\PartnerResource::class => 3,
        \App\Filament\Resources\ServiceResource::class => 3,
        \App\Filament\Resources\SlideResource::class => 3,

        \App\Filament\Resources\ToolResource::class => 4,
        \App\Filament\Resources\SystemLogResource::class => 4,
        \App\Filament\Resources\TauxCommissionResource::class => 4,
        \App\Filament\Resources\CompagnieInfoResource::class => 4,
        \App\Filament\Resources\VehicleBrandResource::class => 4,
        \App\Filament\Pages\AdvisorLinks::class => 4,
        \App\Filament\Pages\ManageSettings::class => 4,

        \App\Filament\Resources\TeamTitleResource::class => 5,
        \App\Filament\Resources\UserResource::class => 5,
        \App\Filament\Resources\EmployeeResource::class => 5,
    ],

    // ✅ Liens externes / panels séparés
    'links' => [
        [
            'label' => 'Analyse des Besoins Financiers',
            'icon'  => 'heroicon-o-arrow-top-right-on-square',
            'url'   => '/abf',
            'group' => 'Espace Conseiller', // le group existant
            'sort'  => 1, // même niveau que AbfCaseResource
            'new_tab' => true,
        ],
    ],
];
