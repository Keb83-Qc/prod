<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompagnieType extends Model
{
    protected $table = 'compagnie_types';
    public $timestamps = false;
    protected $fillable = ['compagnie_id', 'nom_type'];

    public function compagnie()
    {
        return $this->belongsTo(CompagnieInfo::class, 'compagnie_id');
    }
}
