<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('career_pages', function (Blueprint $table) {
            $table->id();
            // Liens des boutons
            $table->string('link_advisor_licensed')->nullable(); // Conseiller avec permis
            $table->string('link_future_advisor')->nullable();   // Futur conseiller
            $table->string('link_agency')->nullable();           // Cabinets
            $table->string('link_team_leader')->nullable();      // Leader d'équipe

            // Optionnel : Titres ou textes si vous voulez les changer via admin
            $table->string('contact_email')->default('candidature@vipgpi.ca');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_pages');
    }
};
