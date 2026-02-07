<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ⚠️ On évite le duplicate column si les colonnes existent déjà
        if (! Schema::hasColumn('team_titles', 'created_at') || ! Schema::hasColumn('team_titles', 'updated_at')) {
            Schema::table('team_titles', function (Blueprint $table) {
                if (! Schema::hasColumn('team_titles', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (! Schema::hasColumn('team_titles', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('team_titles', function (Blueprint $table) {
            if (Schema::hasColumn('team_titles', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('team_titles', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
