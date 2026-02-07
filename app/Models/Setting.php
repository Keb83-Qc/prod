<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Très important : autorise l'écriture massive
    protected $fillable = [
        'key',
        'value',
    ];
}
