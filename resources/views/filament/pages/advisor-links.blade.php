<x-filament-panels::page>

    <div class="grid grid-cols-1 gap-4">
        <div
            class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-gray-900 dark:border-gray-800">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                {{-- resources/views/filament/pages/advisor-links.blade.php --}}

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">Conseiller</th>
                        <th scope="col" class="px-6 py-3">Lien de Consentement & Soumission</th>
                        <th scope="col" class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($advisors as $advisor)
                    @php
                    $link = url('/consentement/' . $advisor->advisor_code);
                    @endphp

                    <tr
                        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        {{-- NOM + AVATAR --}}
                        <td
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center gap-3">
                            @if($advisor->avatar_url)
                            <img src="{{ $advisor->avatar_url }}" class="w-8 h-8 rounded-full object-cover">
                            @else
                            <div
                                class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-xs">
                                {{ substr($advisor->first_name, 0, 1) }}{{ substr($advisor->last_name, 0, 1) }}
                            </div>
                            @endif
                            <div>
                                <div class="font-bold">{{ $advisor->full_name }}</div>
                                <div class="text-xs text-gray-400">{{ $advisor->email }}</div>
                            </div>
                        </td>

                        {{-- Colonne Code retirée ici --}}

                        {{-- APERÇU DU LIEN --}}
                        <td class="px-6 py-4 text-gray-400 truncate max-w-md">
                            {{ $link }}
                        </td>

                        {{-- ACTIONS (Copier + Envoyer) --}}
                        <td class="px-6 py-4 text-center w-48">

                            {{-- BOUTON COPIER --}}
                            <div x-data="{ copied: false }" class="mb-2">
                                <button @click="
                                            navigator.clipboard.writeText('{{ $link }}');
                                            copied = true;
                                            setTimeout(() => copied = false, 2000);
                                        "
                                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-2 focus:outline-none transition-all duration-200 w-full flex items-center justify-center gap-1"
                                    :class="copied ? 'bg-green-600 hover:bg-green-700' : 'bg-primary-600'">
                                    <span x-show="!copied" class="flex items-center gap-1">
                                        <x-heroicon-o-clipboard class="w-4 h-4" /> Copier
                                    </span>
                                    <span x-show="copied" class="flex items-center gap-1" style="display: none;">
                                        <x-heroicon-o-check class="w-4 h-4" /> Copié !
                                    </span>
                                </button>
                            </div>

                            {{-- BOUTON ENVOYER --}}
                            <div>
                                <button wire:click="sendLink({{ $advisor->id }})" wire:loading.attr="disabled"
                                    class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-xs px-3 py-2 focus:outline-none transition-all duration-200 flex items-center justify-center gap-1 w-full">
                                    <span wire:loading.remove wire:target="sendLink({{ $advisor->id }})">
                                        <x-heroicon-o-envelope class="w-4 h-4 inline" /> Envoyer
                                    </span>

                                    <span wire:loading wire:target="sendLink({{ $advisor->id }})">
                                        <svg class="animate-spin h-4 w-4 text-gray-500 inline"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg> Envoi...
                                    </span>
                                </button>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament-panels::page>