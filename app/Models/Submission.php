<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    // 1. Autoriser l'écriture sur ces colonnes
    protected $fillable = [
        'advisor_code',
        'type',
        'current_step',
        'data',
        'client_email',
        'client_phone',
    ];

    // 2. LA CORRECTION EST ICI : On dit à Laravel de traiter 'data' comme un tableau
    protected $casts = [
        'data' => 'array',
    ];
}
