<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\PasswordInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http; // Pour le test
use App\Models\Setting; // Supposez que vous avez un modèle Setting
use Filament\Facades\Filament;

class ManageGoogleReviews extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Google Reviews';
    protected static ?string $title = 'Connexion Google Reviews';
    protected static ?string $navigationGroup = 'Paramètres';

    protected static string $view = 'filament.pages.manage-google-reviews';

    public static function shouldRegisterNavigation(): bool
    {
        $user = Filament::auth()->user();

        return $user
            && ($user->hasRoleByName('super_admin') || $user->hasRoleByName('admin'));
    }

    public static function canAccess(): bool
    {
        $user = Filament::auth()->user();

        return $user
            && ($user->hasRoleByName('super_admin') || $user->hasRoleByName('admin'));
    }

    // Les variables pour le formulaire
    public ?array $data = [];

    public function mount(): void
    {
        // CHARGER LES DONNÉES EXISTANTES
        // Exemple : on va chercher dans la table settings
        // Adaptez ceci selon votre logique de stockage
        $settings = Setting::pluck('value', 'key')->toArray();

        $this->form->fill([
            'google_place_id' => $settings['google_place_id'] ?? '',
            'google_api_key' => $settings['google_api_key'] ?? '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('google_place_id')
                    ->label('Google Place ID')
                    ->placeholder('Ex: ChIJ...')
                    ->required(),

                // CORRECTION ICI :
                TextInput::make('google_api_key')
                    ->password() // C'est ici qu'on le transforme en champ mot de passe
                    ->revealable() // Ajoute le petit œil pour voir/cacher
                    ->label('Clé API Google (Places API)')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // SAUVEGARDE EN BASE DE DONNÉES
        // Exemple basique : Update ou Create
        Setting::updateOrCreate(['key' => 'google_place_id'], ['value' => $data['google_place_id']]);
        Setting::updateOrCreate(['key' => 'google_api_key'], ['value' => $data['google_api_key']]);

        Notification::make()
            ->success()
            ->title('Paramètres enregistrés')
            ->send();
    }

    public function testConnection()
    {
        $data = $this->form->getState();
        $apiKey = $data['google_api_key'];
        $placeId = $data['google_place_id'];

        if (empty($apiKey) || empty($placeId)) {
            Notification::make()->danger()->title('Veuillez remplir les champs d\'abord')->send();
            return;
        }

        // Test réel vers Google
        try {
            // Exemple d'appel API simple pour vérifier (Places Details)
            $response = Http::get("https://maps.googleapis.com/maps/api/place/details/json", [
                'place_id' => $placeId,
                'fields' => 'name,rating',
                'key' => $apiKey,
                'language' => 'fr'
            ]);

            if ($response->successful() && $response->json('status') === 'OK') {
                $name = $response->json('result.name');
                Notification::make()
                    ->success()
                    ->title('Connexion réussie !')
                    ->body("Entreprise trouvée : " . $name)
                    ->send();
            } else {
                Notification::make()
                    ->danger()
                    ->title('Erreur Google')
                    ->body($response->json('error_message') ?? 'Clé ou ID invalide')
                    ->send();
            }
        } catch (\Exception $e) {
            Notification::make()->danger()->title('Erreur technique')->body($e->getMessage())->send();
        }
    }
}
