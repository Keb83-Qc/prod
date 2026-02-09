<x-filament-widgets::widget class="col-span-full">
    <div>
        @php
        $user = \Filament\Facades\Filament::auth()->user();

        // Defaults safe
        $unreadCount = 0;
        $inboxUrl = \App\Filament\Resources\MessageResource::getUrl('index');

        if ($user) {
        $unreadCount = \App\Models\Message::query()
        ->where('receiver_id', $user->id)
        ->where('is_read', false)
        ->count();
        }

        $avatarUrl = $user
        ? ($user->avatar_url ?? filament()->getUserAvatarUrl($user))
        : '';
        @endphp

        <div class="relative rounded-xl p-4 overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700"
            style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">

            {{-- Effet de fond --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#c9a050] opacity-10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

            <div class="relative flex items-center justify-between gap-4">
                {{-- Avatar et Texte --}}
                <div class="flex items-center gap-4">
                    <div class="relative shrink-0">
                        <div class="h-16 w-16 rounded-full border-2 border-[#1e293b] shadow-md overflow-hidden bg-[#0f172a]">
                            @if (!empty($avatarUrl))
                            <img src="{{ $avatarUrl }}" class="w-full h-full object-cover" alt="Avatar">
                            @endif
                        </div>

                        {{-- Pastille en ligne --}}
                        <div class="absolute bottom-0 right-0 h-3.5 w-3.5 bg-green-500 border-2 border-[#1e293b] rounded-full"></div>
                    </div>

                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-[#c9a050] uppercase tracking-wider">
                            {{ now()->isoFormat('dddd D MMMM') }}
                        </span>

                        <h2 class="text-xl font-bold text-white leading-tight">
                            Bonjour, {{ $user?->first_name ?? 'Utilisateur' }}
                        </h2>

                        <p class="text-gray-400 text-xs mt-0.5">
                            Espace administrateur VIP.
                            @if ($unreadCount > 0)
                            <span class="text-amber-400 font-bold ml-1">
                                — Vous avez {{ $unreadCount }} message(s) non lu(s).
                            </span>
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Bouton Messagerie Dynamique --}}
                <div class="shrink-0 hidden sm:block">
                    <a href="{{ $inboxUrl }}"
                        class="group relative flex items-center gap-2 px-4 py-2 bg-[#c9a050] text-[#0E1030] rounded-lg text-sm font-bold shadow-md hover:bg-yellow-500 transition-all">

                        <div class="relative">
                            <x-heroicon-m-envelope class="w-4 h-4 {{ $unreadCount > 0 ? 'animate-pulse' : '' }}" />

                            @if ($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-600"></span>
                            </span>
                            @endif
                        </div>

                        <span>Messagerie</span>

                        @if ($unreadCount > 0)
                        <span class="bg-[#0E1030] text-[#c9a050] text-xs px-1.5 py-0.5 rounded-full ml-1">
                            {{ $unreadCount }}
                        </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>