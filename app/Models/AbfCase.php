<?php

namespace App\Models;

use App\Services\AbfCaseCalculator;
use Illuminate\Database\Eloquent\Model;

class AbfCase extends Model
{
    protected $table = 'abf_cases';

    protected $fillable = [
        'advisor_user_id',
        'advisor_code',
        'status',
        'payload',
        'results',
        'completed_at',
        'signed_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'results' => 'array',
        'completed_at' => 'datetime',
        'signed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $case): void {
            $payload = $case->payload ?? [];

            /** @var AbfCaseCalculator $calculator */
            $calculator = app(AbfCaseCalculator::class);

            $case->results = $calculator->calculate($payload);
        });
    }

    public function getProgressPercentAttribute(): ?int
    {
        $p = $this->results['progress']['percent'] ?? null;
        return $p === null ? null : (int) $p;
    }
}
