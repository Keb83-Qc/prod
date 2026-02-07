<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tool extends Model
{
    public $timestamps = false;

    // Ajout de 'title' dans les casts pour que Laravel traite le JSON automatiquement
    protected $casts = [
        'title' => 'array',
        'description' => 'array', // <--- AJOUTE CECI
    ];

    protected $fillable = ['title', 'category', 'link', 'file_path', 'description', 'icon', 'position'];

    // Récupère la bonne URL (Soit le fichier, soit le lien)
    public function getActionUrlAttribute()
    {
        if ($this->category === 'document' && $this->file_path) {
            if (str_starts_with($this->file_path, 'assets')) {
                return asset($this->file_path);
            }
            return Storage::url($this->file_path);
        }
        return $this->link;
    }
}
