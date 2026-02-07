<x-filament-panels::page>

    <style>
    .vip-card-gradient {
        background: linear-gradient(135deg, #0E1030 0%, #2a2e5c 100%);
    }

    .vip-input {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        transition: all 0.3s ease;
    }

    .vip-input:focus {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: #fbbf24;
        outline: none;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.3);
    }

    .vip-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .vip-select option {
        color: #333;
        background: white;
    }
    </style>

    {{-- GRILLE PRINCIPALE : 1 colonne mobile, 3 colonnes desktop --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

        {{-- COLONNE GAUCHE : PARAMÈTRES --}}
        {{-- p-4 sur mobile, p-6 sur desktop --}}
        <div class="vip-card-gradient rounded-xl shadow-lg p-4 lg:p-6 text-white h-full flex flex-col">

            <div class="flex items-center mb-4 lg:mb-6 pb-3 lg:pb-4 border-b border-white/20">
                <x-heroicon-o-adjustments-horizontal class="w-5 h-5 lg:w-6 lg:h-6 text-amber-400 mr-2" />
                <h2 class="text-lg lg:text-xl font-bold text-amber-400">Paramètres</h2>
            </div>

            <div class="space-y-4 lg:space-y-6 flex-grow">
                {{-- 1. Montant --}}
                <div>
                    <label
                        class="block text-[10px] lg:text-xs font-bold text-gray-300 uppercase tracking-wider mb-1 lg:mb-2">
                        Montant ($)
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-400 font-bold">$</span>
                        <input type="number" wire:model.live.debounce.500ms="amount"
                            class="vip-input w-full rounded-lg py-2 lg:py-3 pl-8 pr-4 text-base lg:text-lg font-bold"
                            placeholder="100000">
                    </div>
                </div>

                {{-- 2. Compagnie --}}
                <div>
                    <label
                        class="block text-[10px] lg:text-xs font-bold text-gray-300 uppercase tracking-wider mb-1 lg:mb-2">
                        Compagnie
                    </label>
                    <select wire:model.live="company"
                        class="vip-input vip-select w-full rounded-lg py-2 lg:py-3 px-3 lg:px-4 cursor-pointer text-sm lg:text-base">
                        <option value="">-- Choisir --</option>
                        @foreach($companiesOptions as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- 3. Type --}}
                <div>
                    <label
                        class="block text-[10px] lg:text-xs font-bold text-gray-300 uppercase tracking-wider mb-1 lg:mb-2">
                        Type de placement
                    </label>
                    <select wire:model.live="type_placement"
                        class="vip-input vip-select w-full rounded-lg py-2 lg:py-3 px-3 lg:px-4 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed text-sm lg:text-base"
                        @if(empty($company)) disabled @endif>
                        <option value="">
                            {{ empty($company) ? "-- D'abord choisir la compagnie --" : "-- Choisir --" }}
                        </option>
                        @foreach($typesOptions as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Note Spéciale --}}
                @if($specialNote)
                <div class="mt-4 p-3 lg:p-4 rounded-lg bg-amber-500/20 border border-amber-500/30">
                    <div class="flex items-start gap-2 lg:gap-3">
                        <x-heroicon-o-information-circle class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" />
                        <div>
                            <strong class="block text-amber-400 text-[10px] lg:text-xs uppercase mb-1">Note
                                Importante</strong>
                            <p class="text-xs lg:text-sm text-gray-200 leading-snug">{{ $specialNote }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- COLONNE DROITE : RÉSULTATS --}}
        <div class="lg:col-span-2">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 h-full flex flex-col overflow-hidden">

                {{-- En-tête Tableau --}}
                <div
                    class="px-4 py-3 lg:px-6 lg:py-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                    <h3 class="text-base lg:text-lg font-bold text-gray-900 dark:text-white">Résultats</h3>
                    <span
                        class="text-[10px] lg:text-xs font-bold px-2 py-1 lg:px-3 lg:py-1 rounded-full bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                        {{ count($results) }} option(s)
                    </span>
                </div>

                {{-- Contenu Tableau --}}
                <div class="flex-grow relative">
                    @if(count($results) > 0)
                    <div class="overflow-x-auto h-full">
                        {{-- Min-width pour forcer le scroll sur très petits écrans --}}
                        <table class="w-full text-left min-w-[600px] lg:min-w-0">
                            <thead
                                class="text-[10px] lg:text-xs text-gray-500 uppercase bg-white border-b dark:bg-gray-900 dark:border-gray-800 sticky top-0 z-10">
                                <tr>
                                    <th class="px-3 py-3 lg:px-6 lg:py-4 font-bold tracking-wider">Option</th>
                                    <th class="px-3 py-3 lg:px-6 lg:py-4 text-center tracking-wider">Taux Mens.</th>
                                    <th class="px-3 py-3 lg:px-6 lg:py-4 text-center tracking-wider">Taux Init.</th>
                                    <th
                                        class="px-3 py-3 lg:px-6 lg:py-4 text-right bg-emerald-50 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-400 tracking-wider">
                                        Mensuel</th>
                                    <th
                                        class="px-3 py-3 lg:px-6 lg:py-4 text-right bg-emerald-50 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-400 tracking-wider">
                                        Initial</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-xs lg:text-sm">
                                @foreach($results as $row)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="px-3 py-3 lg:px-6 lg:py-4 font-bold text-gray-900 dark:text-white">
                                        {{ $row['option'] }}
                                    </td>
                                    <td class="px-3 py-3 lg:px-6 lg:py-4 text-center text-gray-600 font-mono">
                                        {{ number_format($row['taux_mensuel'], 2) }}%
                                    </td>
                                    <td class="px-3 py-3 lg:px-6 lg:py-4 text-center text-gray-600 font-mono">
                                        {{ number_format($row['taux_initial'], 2) }}%
                                    </td>
                                    <td
                                        class="px-3 py-3 lg:px-6 lg:py-4 text-right font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-900/10 whitespace-nowrap">
                                        {{ number_format($row['comm_mensuelle'], 2, ',', ' ') }} $
                                    </td>
                                    <td
                                        class="px-3 py-3 lg:px-6 lg:py-4 text-right font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-900/10 whitespace-nowrap">
                                        {{ number_format($row['comm_initiale'], 2, ',', ' ') }} $
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    {{-- État Vide (Placeholder) --}}
                    <div
                        class="min-h-[200px] lg:absolute lg:inset-0 flex flex-col items-center justify-center text-gray-400 p-6 text-center">
                        <div class="bg-gray-100 dark:bg-gray-800 p-4 lg:p-6 rounded-full mb-3 lg:mb-4">
                            <x-heroicon-o-calculator
                                class="w-10 h-10 lg:w-12 lg:h-12 text-gray-300 dark:text-gray-600" />
                        </div>
                        <p class="text-base lg:text-lg font-medium text-gray-500 dark:text-gray-400">
                            @if(empty($company))
                            Entrez un montant et sélectionnez les critères.
                            @else
                            Aucune donnée trouvée pour cette combinaison.
                            @endif
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

</x-filament-panels::page>
