<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
use App\Models\Employee;
use App\Models\Role;

class User extends Authenticatable implements HasName, FilamentUser
{
    use HasFactory, Notifiable, HasRoles, HasTranslations;

    // 1. Configuration des traductions (Bio uniquement ici)
    public $translatable = ['bio'];

    const ROLE_SUPER_ADMIN = 'super_admin';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'zoho_id', 'zoho_id');
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'zoho_id',
        'advisor_code',
        'password',
        'phone',
        'city',
        'languages',
        'bio',
        'bio_fr',
        'bio_en', // Champs virtuels
        'image',
        'slug',
        'role_id',
        'title_id',
        'position',
        'facebook_url',
        'booking_url',
        'last_login',
        'must_change_password'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login' => 'datetime',
        'must_change_password' => 'boolean',
        'languages' => 'array', // Crucial pour le Select multiple
    ];

    protected $appends = ['bio_fr', 'bio_en', 'image_url', 'full_name'];

    /**
     * BOOT : Génération automatique
     */
    protected static function booted(): void
    {
        // 1. Création : Slug automatique
        static::creating(function (User $user) {
            if (empty($user->slug)) {
                $user->slug = self::generateUniqueSlug($user->first_name, $user->last_name);
            }
        });

        // 2. Mise à jour : Slug dynamique si le nom change
        static::updating(function (User $user) {
            if (($user->isDirty('first_name') || $user->isDirty('last_name')) && !$user->isDirty('slug')) {
                $user->slug = self::generateUniqueSlug($user->first_name, $user->last_name, $user->id);
            }
        });

        // 3. Après création : Advisor Code
        static::created(function (User $user) {
            if ($user->id !== 0 && empty($user->advisor_code)) {
                $user->advisor_code = self::generateCustomAdvisorCode($user);
                $user->saveQuietly();
            }
        });

        static::saved(function (User $user) {
            if ($user->wasChanged('role_id')) {
                $roleName = $user->role?->name;

                // Si pas de rôle ou rôle "en_attente", on retire les rôles spatie
                if (! $roleName || $roleName === 'en_attente') {
                    $user->syncRoles([]);
                    return;
                }

                // Sinon on aligne Spatie sur role_id
                $user->syncRoles([$roleName]);
            }
        });
    }

    // --- FRONTEND ROUTING (AJOUT IMPORTANT) ---
    // Cela permet aux liens comme /conseiller/jean-dupont de fonctionner
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // --- LOGIQUE MÉTIER ---

    public static function generateCustomAdvisorCode(User $user): string
    {
        $first = Str::lower(Str::substr(Str::slug($user->first_name, ''), 0, 2));
        $last = Str::lower(Str::substr(Str::slug($user->last_name, ''), 0, 2));
        $rand = rand(10, 99);
        return "vip{$user->id}{$first}{$last}{$rand}";
    }

    public static function generateUniqueSlug($firstName, $lastName, $ignoreId = null): string
    {
        $baseSlug = Str::slug($firstName . '-' . $lastName);
        $slug = $baseSlug;
        $count = 1;

        while (User::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }
        return $slug;
    }

    // --- LOGIQUE FILAMENT ---
    public function canAccessPanel(Panel $panel): bool
    {
        // Si tu as ton helper hybride (role_id ou spatie), utilise-le :
        $deny = ['en_attente'];

        foreach ($deny as $role) {
            if ($this->hasRoleByName($role)) {
                return false;
            }
        }

        return true;
    }

    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    // --- RELATIONS ---
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function title()
    {
        return $this->belongsTo(TeamTitle::class, 'title_id');
    }

    // --- ACCESSEURS ---

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Gestion robuste de l'image (Assets vs Storage)
    public function getImageUrlAttribute()
    {
        $path = $this->image;

        // 1. Pas d'image ? Image par défaut
        if (empty($path)) {
            return asset('assets/img/agent-default.jpg');
        }

        // 2. URL Externe (Facebook, etc.)
        if (str_starts_with($path, 'http')) {
            return $path;
        }

        // 3. Anciennes images (Assets)
        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        // 4. Nouvelles images (Storage Filament)
        // Utiliser asset() gère mieux le HTTPS que url()
        return asset('storage/' . $path);
    }

    // --- ACCESSEURS TRADUCTION BIO (Compatibilité Legacy) ---

    public function getBioFrAttribute()
    {
        $bio = $this->attributes['bio'] ?? null;
        if (empty($bio)) return null;

        // Si c'est du JSON valide
        json_decode($bio);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $this->getTranslation('bio', 'fr', false);
        }
        // Sinon ancien texte brut
        return $bio;
    }

    public function setBioFrAttribute($value)
    {
        $this->setTranslation('bio', 'fr', $value);
    }

    public function getBioEnAttribute()
    {
        $bio = $this->attributes['bio'] ?? null;
        if (empty($bio)) return null;

        json_decode($bio);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $this->getTranslation('bio', 'en', false);
        }
        return ''; // Pas de traduction anglaise pour les vieux textes bruts
    }

    public function setBioEnAttribute($value)
    {
        $this->setTranslation('bio', 'en', $value);
    }

    // --- HELPERS ---

    public function hasRoleByName(string $roleName): bool
    {
        if ($this->role && $this->role->name === $roleName) {
            return true;
        }
        return $this->hasRole($roleName);
    }

    public static function getAvailableLanguages(): array
    {
        return [
            'fr' => 'Français',
            'en' => 'English',
            'es' => 'Español',
            'it' => 'Italiano',
            'pt' => 'Português',
            'ar' => 'Arabic',
            'ht' => 'Kreyòl',
            'zh' => 'Mandarin',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRoleByName(self::ROLE_SUPER_ADMIN);
    }
}
