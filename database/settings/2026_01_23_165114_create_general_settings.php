<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.banner_active', false);
        $this->migrator->add('general.banner_text', 'Bienvenue sur VIP GPI');
        $this->migrator->add('general.banner_color', '#ffc107');
        $this->migrator->add('general.seo_default_title', 'VIP GPI | Services Financiers');
        $this->migrator->add('general.seo_default_desc', 'Experts en services financiers au Québec.');
    }
};
