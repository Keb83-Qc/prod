<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use App\Mail\AdvisorLinkShare;
use App\Models\SystemLog;

class AdvisorLinks extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationLabel = 'Liens de Consentement';
    protected static ?string $title = 'Liens de Consentement des Conseillers';

    public static function getNavigationGroup(): ?string
    {
        return 'Configuration';
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-navigation.sort.' . static::class);
    }

    protected static string $view = 'filament.pages.advisor-links';

    /**
     * SÉCURITÉ : Qui peut voir cette page ?
     * Super Admin OU Admin
     */
    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // On vérifie si c'est un Super Admin OU un Admin
        return $user->isSuperAdmin() || $user->hasRoleByName('admin');
    }

    /**
     * On envoie la liste des conseillers à la vue
     */
    protected function getViewData(): array
    {
        return [
            // On prend tous les users qui ont un advisor_code, triés par nom
            'advisors' => User::whereNotNull('advisor_code')
                ->where('advisor_code', '!=', '')
                ->where('id', '!=', 0) // On ignore le robot
                ->orderBy('first_name')
                ->get(),
        ];
    }

    /**
     * Action Livewire appelée par le bouton "Envoyer"
     */
    public function sendLink(int $advisorId)
    {
        // 1. Trouver le conseiller
        $advisor = User::find($advisorId);

        if (!$advisor || !$advisor->email) {
            Notification::make()
                ->title('Erreur')
                ->body('Conseiller introuvable ou sans courriel.')
                ->danger()
                ->send();
            return;
        }

        // 2. Générer le lien
        $link = route('consent.show', ['code' => $advisor->advisor_code]);

        // 3. Envoyer le courriel
        try {
            Mail::to($advisor->email)->send(new AdvisorLinkShare($advisor, $link));

            Notification::make()
                ->title('Envoyé !')
                ->body("Le lien a été envoyé à {$advisor->email}")
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Erreur d\'envoi')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }

        SystemLog::record('info', "Lien de consentement envoyé à {$advisor->full_name}");
    }
}
