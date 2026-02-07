<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WikiArticle extends Model
{
    protected $table = 'wiki_articles';

    protected $fillable = [
        'title',
        'category',
        'content',
        'file_path',
        'author_id',
    ];

    // --- GESTION FICHIER JOINT (Ancien + Nouveau) ---
    public function getFileUrlAttribute()
    {
        // 1. Ancien fichier (dans assets/uploads/wiki/)
        if ($this->file_path && str_starts_with($this->file_path, 'assets')) {
            return asset($this->file_path);
        }

        // 2. Nouveau fichier (Filament storage)
        if ($this->file_path) {
            return Storage::url($this->file_path);
        }

        return null;
    }

    // --- RELATIONS ---
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
