<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Identifiant unique de la commande
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Utilisateur ayant passé la commande
            $table->foreignId('livreur_id')->nullable()->constrained('users')->onDelete('set null'); // Livreur assigné
            $table->string('status')->default('pending'); // Statut de la commande (pending, in_progress, delivered, etc.)
            $table->decimal('total_price', 10, 2); // Total de la commande
            $table->boolean('is_delivery')->default(false); // Indique si c'est une commande avec livraison
            $table->string('delivery_address')->nullable(); // Adresse de livraison
            $table->decimal('delivery_price', 10, 2)->default(4000); // Prix de la livraison (par défaut 4000 CDF)
            $table->timestamp('placed_at')->nullable(); // Date et heure de la commande
            $table->timestamp('delivered_at')->nullable(); // Date et heure de la livraison
            $table->timestamps(); // Created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
