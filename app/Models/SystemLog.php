<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Prunable;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = ['level', 'message', 'context', 'user_id', 'ip_address'];

    protected $casts = [
        'context' => 'array',
    ];

    use Prunable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper pour créer un log facilement n'importe où
    public static function record(string $level, string $message, array $context = [])
    {
        self::create([
            'level' => $level,
            'message' => $message,
            'context' => $context,
            'user_id' => auth()->id() ?? null,
            'ip_address' => request()->ip(),
        ]);
    }

    public function prunable()
    {
        // Supprime automatiquement les logs vieux de plus de 30 jours
        return static::where('created_at', '<=', now()->subDays(30));
    }
}
