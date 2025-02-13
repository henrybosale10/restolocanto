<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('orders')->onDelete('cascade'); // Référence à la commande
            $table->string('type'); // 'livraison' ou 'retrait'
            $table->string('adresse')->nullable(); // Adresse uniquement pour livraison
            $table->foreignId('livreur_id')->nullable()->constrained('livreurs')->onDelete('set null'); // Référence au livreur
            $table->timestamp('heure_livraison')->nullable(); // Heure de livraison
            $table->string('statut')->default('en attente'); // 'en attente', 'expédiée', etc.
            $table->integer('prix')->default(4000); // Prix fixe
            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('livraisons');
    }
};
