<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisCommentairesTable extends Migration
{
    public function up()
    {
        Schema::create('avis_commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('contenu');
            $table->integer('note')->nullable(); // Note uniquement pour les avis
            $table->foreignId('parent_id')->nullable()->constrained('avis_commentaires')->onDelete('cascade'); // Pour les commentaires
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avis_commentaires');
    }
}
