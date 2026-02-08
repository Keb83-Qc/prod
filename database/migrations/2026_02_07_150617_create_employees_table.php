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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('zoho_id')->unique(); // ID unique de Zoho
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->nullable(); // Ex: Manager, Agent...
            $table->string('status')->nullable(); // Ex: Active, Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
