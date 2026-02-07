<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserLoginDetails extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tempPassword;

    public function __construct(User $user, string $tempPassword)
    {
        $this->user = $user;
        $this->tempPassword = $tempPassword;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vos informations de connexion VIP GPI',
        );
    }

    public function content(): Content
    {
        // On utilise une vue simple en ligne pour gagner du temps,
        // ou vous pouvez créer un fichier blade resources/views/emails/login_details.blade.php
        return new Content(
            htmlString: '
                <h1>Bonjour ' . $this->user->first_name . ',</h1>
                <p>Voici vos accès pour l\'espace conseiller VIP GPI :</p>
                <ul>
                    <li><strong>Email :</strong> ' . $this->user->email . '</li>
                    <li><strong>Mot de passe temporaire :</strong> ' . $this->tempPassword . '</li>
                </ul>
                <p>Veuillez vous connecter ici : <a href="' . url('/admin') . '">Accéder à l\'espace conseiller</a></p>
                <p><em>Merci de changer ce mot de passe dès votre première connexion.</em></p>
            ',
        );
    }
}
