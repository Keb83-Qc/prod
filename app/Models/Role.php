<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Indique à Laravel que la table s'appelle 'roles'
    protected $table = 'roles';

    // Si votre table n'a pas les colonnes created_at et updated_at
    public $timestamps = false;

    protected $guarded = [];
}
