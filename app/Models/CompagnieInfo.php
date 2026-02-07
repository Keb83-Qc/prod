<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompagnieInfo extends Model
{
    protected $table = 'compagnies_infos';
    public $timestamps = false; // Votre table n'a pas created_at/updated_at
    protected $fillable = ['nom_compagnie', 'note_speciale'];


    protected $casts = [
        'note_speciale' => 'array', // Crucial pour transformer le JSON en tableau PHP
    ];

    // Relation vers les types
    public function types()
    {
        return $this->hasMany(CompagnieType::class, 'compagnie_id');
    }
}
