<?php

namespace App\Models;

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

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_user_id');
    }
}
