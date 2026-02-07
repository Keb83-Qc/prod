<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\UserLoginDetails;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    // 1. On retire le bouton Supprimer de l'en-tête (Header)
    // Si on laisse cette méthode vide, le bouton disparait du haut.
    protected function getHeaderActions(): array
    {
        return [
            // Le bouton standard de suppression
            Actions\DeleteAction::make(),

            // --- NOTRE NOUVEAU BOUTON "ENVOYER ACCÈS" ---
            Actions\Action::make('send_credentials')
                ->label('Envoyer identifiants')
                ->icon('heroicon-o-paper-airplane')
                ->color('info') // Bleu
                ->requiresConfirmation()
                ->modalHeading('Réinitialiser et envoyer les accès ?')
                ->modalDescription('Attention : Ceci va générer un NOUVEAU mot de passe temporaire et l\'envoyer par courriel au conseiller. L\'ancien mot de passe ne fonctionnera plus.')
                ->modalSubmitActionLabel('Envoyer')
                ->action(function (User $record) {
                    // 1. Générer un mot de passe aléatoire (8 caractères)
                    $tempPassword = Str::random(10);

                    // 2. Mettre à jour l'utilisateur
                    $record->update([
                        'password' => Hash::make($tempPassword),
                        'must_change_password' => true, // On force le changement au prochain login
                    ]);

                    // 3. Envoyer le courriel
                    try {
                        Mail::to($record->email)->send(new UserLoginDetails($record, $tempPassword));

                        Notification::make()
                            ->title('Courriel envoyé avec succès !')
                            ->body("Le mot de passe temporaire est : {$tempPassword}") // On l'affiche aussi à l'admin au cas où
                            ->success()
                            ->persistent() // La notif reste affichée jusqu'à fermeture
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Erreur lors de l\'envoi')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }

    // 2. On personnalise la barre d'actions du bas (Form Actions)
    protected function getFormActions(): array
    {
        return [
            // Le bouton Sauvegarder (Standard)
            $this->getSaveFormAction(),

            // Le bouton Annuler (Standard)
            $this->getCancelFormAction(),

            // Le bouton Supprimer (Ajouté ici)
            Actions\DeleteAction::make()
                ->record($this->getRecord()) // Important pour savoir qui supprimer
                ->requiresConfirmation() // Affiche la modale de confirmation
                ->successRedirectUrl($this->getResource()::getUrl('index')), // Redirige vers la liste après suppression
        ];
    }
}
