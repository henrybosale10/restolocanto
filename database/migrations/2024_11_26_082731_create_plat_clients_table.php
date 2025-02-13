<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatClientsTable extends Migration
{
    public function up()
    {
        Schema::create('plat_clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->decimal('prix', 8, 2);
            $table->string('image')->nullable();
            $table->foreignId('plat_id')->constrained()->onDelete('cascade'); // Relation avec Plat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plat_clients');
    }
}

