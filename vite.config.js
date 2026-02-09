import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 'resources/js/app.js',

                // ✅ Filament admin assets
                'resources/css/filament/admin.css',
                'resources/js/filament/admin.js',
            ],



            refresh: true,
        }),
    ],
});
