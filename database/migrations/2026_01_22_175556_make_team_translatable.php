<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // On vide le contenu car les tables n'existent plus suite au migrate:fresh.
        // Les colonnes seront créées directement dans les migrations d'origine.
    }

    public function down()
    {
        // Retour en arrière simple (texte)
        Schema::table('team_titles', function (Blueprint $table) {
            $table->string('title_name', 255)->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->change();
        });
    }
};
