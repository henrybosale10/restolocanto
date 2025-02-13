<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('livreurs', function (Blueprint $table) {
            $table->id();
            $table->string('prenom'); // Prénom du livreur
            $table->string('nom'); // Nom du livreur
            $table->string('email')->unique(); // Email du livreur
            $table->string('telephone')->nullable(); // Numéro de téléphone du livreur
            $table->string('photo_profil')->nullable(); // Photo de profil du livreur
            $table->string('adresse')->nullable(); // Adresse du livreur
            $table->enum('statut', ['disponible', 'occupé', 'en pause'])->default('disponible'); // Statut du livreur
            $table->timestamp('date_embauche')->nullable(); // Date d'embauche du livreur
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('livreurs');
    }
};
