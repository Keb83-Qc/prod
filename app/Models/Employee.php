<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'zoho_id',
        'employee_number',
        'name',
        'email',
        'role',
        'status',
        'zoho_payload',
    ];


    protected $casts = [
        'zoho_payload' => 'array',
    ];
}
