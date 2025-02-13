<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('avis_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Définir les clés étrangères
            $table->foreign('avis_id')->references('id')->on('avis_commentaires')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Empêcher un utilisateur de liker plusieurs fois le même avis
            $table->unique(['avis_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
