<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- COLONNE GAUCHE : LE FORMULAIRE --}}
        <div>
            <x-filament::section>
                <x-slot name="heading">
                    Configuration
                </x-slot>

                {{-- Affiche le formulaire défini dans la classe PHP --}}
                {{ $this->form }}

                <div class="mt-4 text-right">
                    <x-filament::button wire:click="save" color="primary">
                        Enregistrer les paramètres
                    </x-filament::button>
                </div>
            </x-filament::section>

            {{-- BOUTON DE TEST (Optionnel) --}}
            <x-filament::section class="mt-6">
                <x-slot name="heading">Test de connexion</x-slot>
                <p class="text-sm text-gray-500 mb-4">Cliquez ici pour vérifier si la clé fonctionne et récupérer les
                    avis.</p>
                <x-filament::button wire:click="testConnection" color="success" icon="heroicon-o-check-circle">
                    Lancer une synchronisation manuelle
                </x-filament::button>
            </x-filament::section>
        </div>

        {{-- COLONNE DROITE : AIDE & TUTORIEL --}}
        <div class="space-y-6">
            <x-filament::section>
                <x-slot name="heading">
                    Comment se connecter ?
                </x-slot>

                <div class="prose max-w-none text-sm text-gray-600 dark:text-gray-300">
                    <h3 class="font-bold text-lg text-primary-600">Étape 1 : Google Place ID</h3>
                    <p>Le <strong>Place ID</strong> est l'identifiant unique de votre entreprise sur Google Maps.</p>
                    <ol class="list-decimal pl-5 space-y-2">
                        <li>Allez sur le <a
                                href="https://developers.google.com/maps/documentation/places/web-service/place-id"
                                target="_blank" class="text-primary-500 underline">Place ID Finder</a>.</li>
                        <li>Tapez le nom de votre entreprise dans la carte.</li>
                        <li>Copiez le code qui commence par <code>ChIJ...</code>.</li>
                    </ol>

                    <hr class="my-4 border-gray-200">

                    <h3 class="font-bold text-lg text-primary-600">Étape 2 : Clé API Google</h3>
                    <p>Vous avez besoin d'une clé API avec l'accès à <strong>Places API</strong>.</p>
                    <ol class="list-decimal pl-5 space-y-2">
                        <li>Allez sur <a href="https://console.cloud.google.com/" target="_blank"
                                class="text-primary-500 underline">Google Cloud Console</a>.</li>
                        <li>Créez un projet.</li>
                        <li>Allez dans "API et Services" > "Bibliothèque".</li>
                        <li>Cherchez et activez <strong>Places API (New)</strong>.</li>
                        <li>Créez des identifiants (API Key) et copiez la clé ici.</li>
                    </ol>

                    <div class="bg-yellow-50 p-3 rounded border border-yellow-200 mt-4 text-yellow-800 text-xs">
                        <strong>Note :</strong> Assurez-vous que la facturation est activée sur Google Cloud (même si
                        c'est souvent gratuit pour un usage basique).
                    </div>
                </div>
            </x-filament::section>
        </div>
    </div>
</x-filament-panels::page>