<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class AdvisorLinkShare extends Mailable
{
    use Queueable, SerializesModels;

    public $advisor;
    public $link;

    public function __construct(User $advisor, string $link)
    {
        $this->advisor = $advisor;
        $this->link = $link;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@vipgpi.ca', 'VIP GPI Soumissions'),
            subject: 'Ton lien de consentement client - VIP GPI',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.advisor-link-share', // On va créer cette vue
        );
    }
}
