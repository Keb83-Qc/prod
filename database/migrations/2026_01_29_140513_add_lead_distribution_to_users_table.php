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
        Schema::table('users', function (Blueprint $table) {
            // Est-ce que ce conseiller peut recevoir des leads du site ?
            $table->boolean('accepts_leads')->default(false);

            // Priorité (1 = Normal, 2 = Reçoit 2x plus, etc.)
            $table->integer('lead_weight')->default(1);

            // Compteur pour le cycle actuel (se remet à 0 quand le cycle finit)
            $table->integer('leads_received_cycle')->default(0);

            // Date du dernier lead reçu (pour départager équitablement)
            $table->timestamp('last_lead_received_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
