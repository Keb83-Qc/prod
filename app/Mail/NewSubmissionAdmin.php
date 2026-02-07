<?php

namespace App\Mail;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewSubmissionAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public Submission $submission;
    public ?User $advisor; // Le point d'interrogation signifie que ça peut être null

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
        $this->advisor = User::where('advisor_code', $submission->advisor_code)->first();
    }

    public function envelope(): Envelope
    {
        // 1. Nom du conseiller (ou Général)
        $advisorName = $this->advisor ? $this->advisor->first_name : 'Général';

        // 2. Nom du client (Sécurisé avec ??)
        $data = $this->submission->data;
        $clientName = ($data['first_name'] ?? 'Client') . ' ' . ($data['last_name'] ?? '');

        // 3. Type de soumission (ex: Auto, Habitation) - Première lettre majuscule
        $type = ucfirst($this->submission->type ?? 'Soumission');

        // Résultat : "[Auto] Nouvelle Soumission (Julie) - Jean Dupont"
        return new Envelope(
            subject: "[$type] Nouvelle Soumission ($advisorName) - $clientName",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-submission',
        );
    }
}
