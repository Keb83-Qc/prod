<x-filament-panels::page>
    <div x-data="{ search: '' }" style="color: #1f2937 !important;">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold flex items-center gap-3"
                    style="color: #111827 !important; margin-bottom: 0.5rem;">
                    <i class="fas fa-toolbox" style="color: #2563eb !important;"></i> Boîte à Outils
                </h2>
                <p style="color: #6b7280 !important;"> Ressources, calculateurs et liens rapides pour votre activité.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <div class="relative w-full md:w-80 shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search" style="color: #9ca3af !important;"></i>
                    </div>
                    <input type="text" x-model="search" placeholder="Rechercher un outil..."
                        style="background-color: #ffffff !important; color: #000000 !important; border: 1px solid #d1d5db !important;"
                        class="block w-full pl-10 pr-3 py-2 rounded-lg leading-5 focus:ring-1 focus:ring-blue-500">
                </div>

                @if($isAdmin)
                <a href="/admin/tools"
                    style="background-color: #111827 !important; color: #ffffff !important; border: 1px solid #111827 !important;"
                    class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-lg shadow hover:opacity-90 transition">
                    <i class="fas fa-cog mr-2"></i>
                    Gérer
                </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="flex flex-col h-full rounded-xl shadow-sm overflow-hidden"
                style="background-color: #ffffff !important; border: 1px solid #e5e7eb !important;">

                <div class="px-6 py-4 flex items-center gap-4"
                    style="background-color: #ffffff !important; border-bottom: 1px solid #f3f4f6 !important;">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center"
                        style="background-color: #eff6ff !important; color: #2563eb !important;">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h5 class="font-bold text-lg m-0" style="color: #111827 !important;">Calculateurs</h5>
                </div>

                <div class="divide-y divide-gray-100" style="background-color: #ffffff !important;">

                    <a href="/admin/premium-calculator"
                        x-show="search === '' || 'calculateur de primes vip'.includes(search.toLowerCase())"
                        class="block p-5 transition group"
                        style="background-color: #fefce8 !important; border-left: 4px solid #facc15 !important;">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <div style="color: #eab308 !important;"> <i class="fas fa-star fa-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-base transition" style="color: #111827 !important;">
                                        Calculateur de Primes VIP</h4>
                                    <p class="text-sm mt-0.5" style="color: #6b7280 !important;">Estimateur de
                                        commissions en temps réel.</p>
                                </div>
                            </div>

                            @if($isAdmin)
                            <object class="relative z-10">
                                <a href="/admin/tool-premium-config" class="p-2 transition"
                                    style="color: #9ca3af !important;">
                                    <i class="fas fa-cog"></i>
                                </a>
                            </object>
                            @endif
                        </div>
                    </a>

                    @foreach($calculators as $tool)
                    <a href="{{ $tool->action_url }}" target="_blank"
                        x-show="search === '' || '{{ strtolower(addslashes($tool->title)) }}'.includes(search.toLowerCase())"
                        class="flex items-center gap-4 p-4 transition group hover:bg-gray-50"
                        style="background-color: #ffffff !important; border-top: 1px solid #f3f4f6 !important;">
                        <div class="w-8 text-center" style="color: #9ca3af !important;">
                            <i class="{{ $tool->icon }} fa-lg"></i>
                        </div>
                        <span class="font-semibold" style="color: #1f2937 !important;">{{ $tool->title }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            @if($documents->isNotEmpty())
            <div class="flex flex-col h-full rounded-xl shadow-sm overflow-hidden"
                style="background-color: #ffffff !important; border: 1px solid #e5e7eb !important;">

                <div class="px-6 py-4 flex items-center gap-4"
                    style="background-color: #ffffff !important; border-bottom: 1px solid #f3f4f6 !important;">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center"
                        style="background-color: #fef2f2 !important; color: #ef4444 !important;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h5 class="font-bold text-lg m-0" style="color: #111827 !important;">Documents & Formulaires</h5>
                </div>

                <div class="divide-y divide-gray-100" style="background-color: #ffffff !important;">
                    @foreach($documents as $doc)
                    <a href="{{ $doc->action_url }}" target="_blank"
                        x-show="search === '' || '{{ strtolower(addslashes($doc->title)) }}'.includes(search.toLowerCase())"
                        class="block p-4 transition group hover:bg-gray-50"
                        style="background-color: #ffffff !important; border-top: 1px solid #f3f4f6 !important;">
                        <div class="flex items-start gap-4">
                            <div class="mt-1 opacity-80 group-hover:opacity-100 transition"
                                style="color: #f87171 !important;">
                                <i class="{{ $doc->icon }} fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm md:text-base transition"
                                    style="color: #1f2937 !important;">{{ $doc->title }}</h4>
                                @if($doc->description)
                                <p class="text-sm mt-1" style="color: #6b7280 !important;">{{ $doc->description }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        @if($links->isNotEmpty())
        <div class="mt-8">
            <h6 class="font-bold uppercase text-xs tracking-wider mb-4 pl-1 flex items-center gap-2"
                style="color: #6b7280 !important;">
                <i class="fas fa-external-link-alt"></i>
                Accès Assureurs & Partenaires
            </h6>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($links as $link)
                <a href="{{ $link->action_url }}" target="_blank"
                    x-show="search === '' || '{{ strtolower(addslashes($link->title)) }}'.includes(search.toLowerCase())"
                    class="group flex flex-col items-center justify-center p-4 rounded-xl shadow-sm hover:-translate-y-1 hover:shadow-md transition-all duration-200"
                    style="background-color: #ffffff !important; border: 1px solid #e5e7eb !important;">

                    <div class="mb-3 opacity-75 group-hover:opacity-100 transition" style="color: #374151 !important;">
                        <i class="{{ $link->icon }} fa-2x"></i>
                    </div>

                    <div class="text-xs font-bold text-center truncate w-full px-2" style="color: #1f2937 !important;">
                        {{ $link->title }}
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</x-filament-panels::page>
