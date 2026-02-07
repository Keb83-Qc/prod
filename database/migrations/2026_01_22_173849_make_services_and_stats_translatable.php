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
        // Code pour revenir en arrière (simplifié)
        Schema::table('services', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('description')->change();
        });
    }
};
