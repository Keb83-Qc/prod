<x-filament-widgets::widget class="col-span-full">
    <div>
        @php
        $user = \Filament\Facades\Filament::auth()->user();

        $can = function (array $roles = [], ?string $permission = null) use ($user) {
        if (! $user) return false;

        if ($permission) {
        return $user->can($permission);
        }

        if (! empty($roles)) {
        // ton hasRoleByName() attend une string => any()
        return collect($roles)->contains(fn ($r) => $user->hasRoleByName($r));
        }

        return true;
        };

        $links = [
        [
        'label' => 'Équipe',
        'href' => '/admin/users',
        'icon' => 'users',
        'color' => 'text-blue-400',
        'roles' => ['admin', 'super_admin'],
        ],
        [
        'label' => 'Blog',
        'href' => '/admin/blog-posts',
        'icon' => 'document-text',
        'color' => 'text-purple-400',
        'roles' => ['marketing', 'admin', 'super_admin'],
        ],
        [
        'label' => 'Procédures',
        'href' => '/admin/wiki-articles', // ✅ ton lien
        'icon' => 'document-check',
        'color' => 'text-sky-400',
        'roles' => ['conseiller', 'admin', 'super_admin', 'marketing'],
        ],
        [
        'label' => 'Soumission Auto',
        'href' => '/admin/submissions', // ✅ ton lien
        'icon' => 'truck',
        'color' => 'text-lime-400',
        'roles' => ['conseiller', 'admin', 'super_admin'],
        ],
        [
        'label' => 'ABF',
        'href' => '/abf',
        'icon' => 'arrow-top-right-on-square',
        'color' => 'text-amber-400',
        'new_tab' => true,
        'roles' => ['conseiller', 'admin', 'super_admin'],
        ],
        [
        'label' => 'Site Web',
        'href' => '/',
        'icon' => 'globe-alt',
        'color' => 'text-emerald-400',
        'new_tab' => true,
        'roles' => ['conseiller', 'marketing', 'admin', 'super_admin'],
        ],
        ];

        $links = collect($links)
        ->filter(fn ($l) => $can($l['roles'] ?? [], $l['permission'] ?? null))
        ->values();
        @endphp

        <div class="mt-2 mb-2">
            <h3 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                <span class="w-1 h-4 bg-[#c9a050] rounded-full"></span>
                Accès Rapides
            </h3>

            @if ($links->isEmpty())
            <div class="text-sm text-gray-400">
                Aucun accès rapide disponible pour votre rôle.
            </div>
            @else
            <div class="flex flex-wrap gap-3">
                @foreach ($links as $link)
                <a href="{{ $link['href'] }}"
                    @if(!empty($link['new_tab'])) target="_blank" rel="noopener noreferrer" @endif
                    class="w-40 group relative flex flex-col items-center justify-center p-3 bg-[#1e293b] border border-gray-700 rounded-lg hover:border-[#c9a050] transition-all hover:-translate-y-1">

                    @switch($link['icon'])
                    @case('users')
                    <x-heroicon-o-users class="w-6 h-6 {{ $link['color'] ?? 'text-gray-300' }} mb-1 group-hover:text-white" />
                    @break
                    @case('document-text')
                    <x-heroicon-o-document-text class="w-6 h-6 {{ $link['color'] ?? 'text-gray-300' }} mb-1 group-hover:text-white" />
                    @break
                    @case('document-check')
                    <x-heroicon-o-document-check class="w-6 h-6 {{ $link['color'] ?? 'text-gray-300' }} mb-1 group-hover:text-white" />
                    @break
                    @case('truck')
                    <x-heroicon-o-truck class="w-6 h-6 {{ $link['color'] ?? 'text-gray-300' }} mb-1 group-hover:text-white" />
                    @break
                    @case('arrow-top-right-on-square')
                    <x-heroicon-o-arrow-top-right-on-square class="w-6 h-6 {{ $link['color'] ?? 'text-gray-300' }} mb-1 group-hover:text-white" />
                    @break
                    @case('globe-alt')
                    <x-heroicon-o-globe-alt class="w-6 h-6 {{ $link['color'] ?? 'text-gray-300' }} mb-1 group-hover:text-white" />
                    @break
                    @default
                    <x-heroicon-o-link class="w-6 h-6 {{ $link['color'] ?? 'text-gray-300' }} mb-1 group-hover:text-white" />
                    @endswitch

                    <span class="text-sm font-bold text-gray-200 group-hover:text-white">
                        {{ $link['label'] }}
                    </span>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>