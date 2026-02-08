<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('abf_cases', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Conseiller lié
            $table->unsignedBigInteger('advisor_user_id');
            $table->string('advisor_code', 50);

            // Statut (brouillon, complété, signé…)
            $table->string('status', 20)->default('draft');

            // Données ABF (client + conjoint + tout le reste)
            $table->json('payload')->nullable();

            // Calculs plus tard (besoins, écarts, etc.)
            $table->json('results')->nullable();

            $table->timestamp('completed_at')->nullable();
            $table->timestamp('signed_at')->nullable();

            $table->timestamps();

            $table->index(['advisor_user_id', 'status']);
            $table->index('advisor_code');

            $table->foreign('advisor_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abf_cases');
    }
};
