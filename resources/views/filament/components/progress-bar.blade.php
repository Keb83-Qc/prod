@props([
'percent' => 0,
'label' => 'Progression',
])

@php
$percent = max(0, min(100, (int) $percent));
@endphp

<div class="fi-abf-progress rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 p-4">
    <div class="flex items-center justify-between gap-4">
        <div class="text-sm font-medium text-gray-950 dark:text-white">
            {{ $label }}
        </div>

        <div class="text-sm font-semibold text-gray-950 dark:text-white tabular-nums">
            {{ $percent }}%
        </div>
    </div>

    <div class="mt-3 h-2 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-white/10">
        <div
            class="h-full rounded-full bg-primary-600 dark:bg-primary-500 transition-[width] duration-300"
            style="width: {{ $percent }}%;"></div>
    </div>

    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
        Sections complétées : {{ $percent }}%
    </div>
</div>