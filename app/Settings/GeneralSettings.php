<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $banner_active;
    public ?string $banner_text;
    public string $banner_color;
    public string $seo_default_title;
    public string $seo_default_desc;

    public static function group(): string
    {
        return 'general'; // Nom du groupe en base de données
    }
}
