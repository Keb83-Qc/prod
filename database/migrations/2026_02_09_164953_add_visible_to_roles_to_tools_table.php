<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_visible_to_roles_to_tools_table.php
    public function up(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->json('visible_to_roles')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->dropColumn('visible_to_roles');
        });
    }
};
