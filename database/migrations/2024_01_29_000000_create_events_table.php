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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Les champs de base (traductibles souvent)
            $table->json('title')->nullable(); // ou ->string('title') si pas de trad
            $table->json('description')->nullable(); // ou ->text('description')
            $table->string('slug')->nullable();

            // Les champs requis par votre erreur SQL
            $table->date('event_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('is_internal')->default(false); // 0 = Public, 1 = Interne

            // Infos complémentaires
            $table->string('location')->nullable();
            $table->string('image')->nullable();
            $table->string('registration_link')->nullable();

            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
