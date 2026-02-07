<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Models\Message;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group; // Pour grouper les colonnes
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Facades\Filament;

class EditProfile extends Page implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Mon Profil';
    protected static ?string $title = 'Mon Profil';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.edit-profile';
    protected static ?string $slug = 'profil';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                // ON CRÉE UNE GRILLE GLOBALE DE 3 COLONNES
                Grid::make(3)->schema([

                    // --- COLONNE GAUCHE (Prend 1/3 de la largeur) ---
                    // Contient : Avatar + Mot de passe
                    Group::make()->columnSpan(1)->schema([

                        // BLOC 1 : PHOTO
                        Section::make()
                            ->schema([
                                Placeholder::make('avatar_preview')
                                    ->label('') // Pas de label pour gagner de la place
                                    ->content(function () {
                                        $user = auth()->user();
                                        // On utilise image_url ou avatar_url selon votre modèle
                                        $url = $user->image_url;

                                        return new HtmlString("
                                            <div class='flex flex-col items-center justify-center'>
                                                <div class='relative'>
                                                    <img src='{$url}' class='w-32 h-32 rounded-full shadow-lg object-cover border-4 border-white' style='object-fit:cover;' onerror=\"this.src='/assets/img/agent-default.jpg'\">
                                                </div>
                                                <div class='mt-2 text-sm text-gray-500 font-bold'>
                                                    {$user->first_name} {$user->last_name}
                                                </div>
                                            </div>
                                        ");
                                    }),

                                FileUpload::make('image')
                                    ->label('Changer la photo')
                                    ->avatar()
                                    ->alignCenter()
                                    ->directory('uploads/team')
                                    ->visibility('public'),
                            ]),

                        // BLOC 2 : SÉCURITÉ (Juste en dessous de la photo)
                        Section::make('Sécurité')
                            ->description('Changer le mot de passe')
                            ->icon('heroicon-o-lock-closed')
                            ->compact() // Rend la section plus fine
                            ->collapsed() // Replié par défaut pour ne pas gêner
                            ->schema([
                                TextInput::make('new_password')
                                    ->label('Nouveau mot de passe')
                                    ->password()
                                    ->revealable()
                                    ->rule(Password::default()),

                                TextInput::make('new_password_confirmation')
                                    ->label('Confirmer')
                                    ->password()
                                    ->same('new_password')
                                    ->requiredWith('new_password'),
                            ]),
                    ]),

                    // --- COLONNE DROITE (Prend 2/3 de la largeur) ---
                    // Contient : Infos persos + Langues + Bio
                    Group::make()->columnSpan(2)->schema([

                        Section::make('Informations Personnelles')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                // Ligne 1 : Nom / Prénom
                                Grid::make(2)->schema([
                                    TextInput::make('first_name')
                                        ->label('Prénom')
                                        ->disabled()
                                        ->prefixIcon('heroicon-m-user'),
                                    TextInput::make('last_name')
                                        ->label('Nom')
                                        ->disabled()
                                        ->prefixIcon('heroicon-m-user'),
                                ]),

                                // Ligne 2 : Email / Téléphone
                                Grid::make(2)->schema([
                                    TextInput::make('email')
                                        ->label('Email')
                                        ->email()
                                        ->required()
                                        ->prefixIcon('heroicon-m-envelope')
                                        ->unique(User::class, 'email', ignoreRecord: true),

                                    TextInput::make('phone')
                                        ->label('Téléphone')
                                        ->tel()
                                        ->prefixIcon('heroicon-m-phone'),
                                ]),

                                // Ligne 3 : Langues / Facebook
                                Grid::make(2)->schema([
                                    Select::make('languages')
                                        ->label('Langues parlées')
                                        ->multiple()
                                        ->options(User::getAvailableLanguages())
                                        ->searchable()
                                        ->preload()
                                        ->prefixIcon('heroicon-m-language')
                                        ->columnSpan(1),

                                    TextInput::make('facebook_url')
                                        ->label('Lien Facebook')
                                        ->prefixIcon('heroicon-o-globe-alt')
                                        ->url()
                                        ->columnSpan(1),
                                ]),
                            ]),

                        // Section Bio séparée pour la clarté
                        Section::make('Ma Biographie')
                            ->icon('heroicon-o-document-text')
                            ->collapsed()
                            ->schema([
                                Textarea::make('bio')
                                    ->label('Texte actuel (Lecture seule)')
                                    ->disabled()
                                    ->formatStateUsing(function ($state) {
                                        if (is_array($state)) {
                                            $locale = app()->getLocale();
                                            return $state[$locale] ?? $state['fr'] ?? $state['en'] ?? '';
                                        }

                                        return is_string($state) ? $state : '';
                                    })
                                    ->dehydrated(false)
                                    ->rows(4),


                                Placeholder::make('info_modif')
                                    ->content(new HtmlString("<p class='text-sm text-gray-500 italic'>Pour modifier ce texte, utilisez le bouton 'Demander modif. Bio' en haut à droite.</p>"))
                            ]),
                    ]),
                ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = auth()->user();

        if (!empty($data['new_password'])) {
            $data['password'] = Hash::make($data['new_password']);
        }
        unset($data['new_password'], $data['new_password_confirmation']);

        $user->update($data);

        Notification::make()
            ->success()
            ->title('Profil mis à jour')
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('requestBio')
                ->label('Demander modif. Bio')
                ->icon('heroicon-o-pencil-square')
                ->color('warning')
                ->modalHeading('Demande de modification')
                ->form([
                    Textarea::make('bio_request')
                        ->label('Vos changements')
                        ->required()
                        ->rows(5),
                ])
                ->action(function (array $data) {
                    $me = Filament::auth()->user();

                    if (! $me) {
                        Notification::make()
                            ->danger()
                            ->title("Utilisateur non authentifié")
                            ->send();
                        return;
                    }

                    // ✅ Envoie à TOUS les admins / super_admin
                    $admins = User::query()
                        ->whereHas('role', fn($q) => $q->whereIn('name', ['super_admin', 'admin']))
                        ->get();

                    if ($admins->isEmpty()) {
                        Notification::make()
                            ->danger()
                            ->title("Aucun admin trouvé (roles: super_admin/admin)")
                            ->send();
                        return;
                    }

                    foreach ($admins as $admin) {
                        Message::create([
                            'sender_id' => $me->id,
                            'receiver_id' => $admin->id,
                            'subject' => 'Demande modif BIO : ' . ($me->full_name ?? "{$me->first_name} {$me->last_name}"),
                            'body' => $data['bio_request'],
                            'is_read' => false,
                            'data' => [
                                'type' => 'bio_change_request',
                                'target_user_id' => $me->id,
                                'proposed_bio' => $data['bio_request'],
                                'locale' => app()->getLocale(), // optionnel mais pratique
                            ],
                        ]);
                    }


                    Notification::make()
                        ->success()
                        ->title('Demande envoyée !')
                        ->send();
                }),
        ];
    }
}
