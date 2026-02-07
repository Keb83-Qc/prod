<x-filament-widgets::widget class="col-span-full">
    <div class="mt-2 mb-2">

        <h3 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
            <span class="w-1 h-4 bg-[#c9a050] rounded-full"></span>
            Accès Rapides
        </h3>

        {{-- Changement ici : flex-wrap permet de passer à la ligne si besoin --}}
        <div class="flex flex-wrap gap-3">

            {{-- Ajoutez 'w-40' (160px) ou 'w-32' (128px) à chaque lien --}}
            <a href="/admin/users"
                class="w-40 group relative flex flex-col items-center justify-center p-3 bg-[#1e293b] border border-gray-700 rounded-lg hover:border-[#c9a050] transition-all hover:-translate-y-1">
                <x-heroicon-o-users class="w-6 h-6 text-blue-400 mb-1 group-hover:text-white" />
                <span class="text-sm font-bold text-gray-200 group-hover:text-white">Équipe</span>
            </a>

            <a href="/admin/blog-posts"
                class="w-40 group relative flex flex-col items-center justify-center p-3 bg-[#1e293b] border border-gray-700 rounded-lg hover:border-[#c9a050] transition-all hover:-translate-y-1">
                <x-heroicon-o-document-text class="w-6 h-6 text-purple-400 mb-1 group-hover:text-white" />
                <span class="text-sm font-bold text-gray-200 group-hover:text-white">Blog</span>
            </a>

            <a href="/admin/wiki-articles"
                class="w-40 group relative flex flex-col items-center justify-center p-3 bg-[#1e293b] border border-gray-700 rounded-lg hover:border-[#c9a050] transition-all hover:-translate-y-1">
                <x-heroicon-o-book-open class="w-6 h-6 text-orange-400 mb-1 group-hover:text-white" />
                <span class="text-sm font-bold text-gray-200 group-hover:text-white">Wiki</span>
            </a>

            <a href="/" target="_blank"
                class="w-40 group relative flex flex-col items-center justify-center p-3 bg-[#1e293b] border border-gray-700 rounded-lg hover:border-[#c9a050] transition-all hover:-translate-y-1">
                <x-heroicon-o-globe-alt class="w-6 h-6 text-emerald-400 mb-1 group-hover:text-white" />
                <span class="text-sm font-bold text-gray-200 group-hover:text-white">Site Web</span>
            </a>

        </div>
    </div>
</x-filament-widgets::widget>
