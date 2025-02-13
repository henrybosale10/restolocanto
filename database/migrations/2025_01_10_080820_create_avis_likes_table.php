<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisLikesTable extends Migration
{
    public function up()
    {
        Schema::create('avis_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('avis_commentaire_id'); // Correctement nommé
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_like');
            $table->timestamps();

            $table->foreign('avis_commentaire_id')->references('id')->on('avis_commentaires')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['avis_commentaire_id', 'user_id']); // Empêche les doublons
        });
    }


    public function down()
    {
        Schema::dropIfExists('avis_likes');
    }
}
