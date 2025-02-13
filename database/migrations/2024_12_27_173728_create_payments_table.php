<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Lien direct avec l'utilisateur (client)
            $table->foreignId('commande_id')->constrained('orders')->onDelete('cascade'); // Lien avec la commande
            $table->string('methode_paiement'); // Exemple : 'maxicash'
            $table->string('transaction_id')->nullable(); // ID unique généré par Maxicash
            $table->string('statut')->default('en attente'); // 'en attente', 'completé', 'échoué'
            $table->timestamp('date_paiement')->nullable(); // Date et heure du paiement
            $table->timestamps(); // created_at et updated_at
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
