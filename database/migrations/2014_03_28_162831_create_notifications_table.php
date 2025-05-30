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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('content'); // Contenu de la notification
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // ID du candidat qui envoie la candidatures
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete(); // ID du recruteur qui recois la candidature
            $table->boolean('is_read')->default(false); // Indicateur de lecture
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
