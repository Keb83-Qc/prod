<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'body',
        'is_read',
        'data',
        'status',
        'handled_at',
        'handled_by',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'handled_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::created(function (Message $message) {
            $receiver = $message->receiver;

            $senderName = $message->sender
                ? $message->sender->first_name . ' ' . $message->sender->last_name
                : 'Système VIP';

            if ($receiver && $receiver->email) {
                try {
                    Mail::raw(
                        "Bonjour {$receiver->first_name},\n\n" .
                            "Vous avez reçu un nouveau message interne de : {$senderName}.\n\n" .
                            "Sujet : {$message->subject}\n\n" .
                            "Connectez-vous à votre portail VIP GPI pour lire le contenu.\n\n" .
                            "Cordialement,\nL'équipe VIP Services Financiers",
                        function ($mail) use ($receiver, $senderName, $message) {
                            $mail->from('no-reply@vipgpi.ca', 'VIP GPI')
                                ->to($receiver->email)
                                ->replyTo(optional($message->sender)->email, $senderName)
                                ->subject("Nouveau message interne de $senderName");
                        }
                    );
                } catch (\Exception $e) {
                    // Ne pas bloquer l'app si le mail échoue
                }
            }
        });
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
