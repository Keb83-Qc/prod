<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('google_reviews', function (Blueprint $table) {
            $table->id();

            // L'ID unique donné par Google (pour éviter d'importer 2 fois le même avis)
            $table->string('google_review_id')->unique();

            // Infos de l'auteur
            $table->string('author_name');
            $table->text('author_photo_url')->nullable();

            // Contenu de l'avis
            $table->integer('rating'); // Note de 1 à 5
            $table->text('text')->nullable(); // Le commentaire écrit
            $table->string('language')->nullable(); // ex: 'fr', 'en' (utile si vous voulez filtrer par langue)

            // Date de l'avis (timestamp Unix fourni par Google)
            $table->timestamp('review_time');

            // Modération : Par défaut TRUE, mais vous pourrez le passer à FALSE via Filament
            $table->boolean('is_visible')->default(true);

            $table->timestamps(); // created_at, updated_at (date de l'import)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_reviews');
    }
};
